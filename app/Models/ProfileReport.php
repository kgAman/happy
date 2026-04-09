<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'reported_profile_id',
        'report_type',
        'description',
        'evidence',
        'status',
        'resolved_by',
        'resolution_notes',
        'resolved_at',
        'severity_level',
        'is_urgent',
        'assigned_to',
        'priority',
        'resolution_action',
        'notify_reporter',
    ];

    protected $casts = [
        'evidence' => 'array',
        'resolved_at' => 'datetime',
        'is_urgent' => 'boolean',
        'notify_reporter' => 'boolean',
        'severity_level' => 'integer',
        'priority' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Report type constants
    const TYPE_FAKE_PROFILE = 'fake_profile';
    const TYPE_INAPPROPRIATE_CONTENT = 'inappropriate_content';
    const TYPE_HARASSMENT = 'harassment';
    const TYPE_SPAM = 'spam';
    const TYPE_OTHER = 'other';
    const TYPE_SCAM = 'scam';
    const TYPE_UNDERAGE = 'underage';
    const TYPE_MISREPRESENTATION = 'misrepresentation';

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_UNDER_REVIEW = 'under_review';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_DISMISSED = 'dismissed';

    // Resolution actions
    const ACTION_WARNING = 'warning';
    const ACTION_PROFILE_SUSPENSION = 'profile_suspension';
    const ACTION_PROFILE_DELETION = 'profile_deletion';
    const ACTION_CONTENT_REMOVAL = 'content_removal';
    const ACTION_NO_ACTION = 'no_action';
    const ACTION_ESCALATED = 'escalated';

    // Relationships
    public function reporter()
    {
        return $this->belongsTo(Profile::class, 'reporter_id');
    }

    public function reportedProfile()
    {
        return $this->belongsTo(Profile::class, 'reported_profile_id');
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Accessors
    public function getReportTypeLabelAttribute()
    {
        $labels = [
            self::TYPE_FAKE_PROFILE => 'Fake Profile',
            self::TYPE_INAPPROPRIATE_CONTENT => 'Inappropriate Content',
            self::TYPE_HARASSMENT => 'Harassment',
            self::TYPE_SPAM => 'Spam',
            self::TYPE_OTHER => 'Other',
            self::TYPE_SCAM => 'Scam/Fraud',
            self::TYPE_UNDERAGE => 'Underage User',
            self::TYPE_MISREPRESENTATION => 'Misrepresentation',
        ];
        
        return $labels[$this->report_type] ?? $this->report_type;
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING => 'Pending Review',
            self::STATUS_UNDER_REVIEW => 'Under Review',
            self::STATUS_RESOLVED => 'Resolved',
            self::STATUS_DISMISSED => 'Dismissed',
        ];
        
        return $labels[$this->status] ?? $this->status;
    }

    public function getSeverityLabelAttribute()
    {
        $labels = [
            1 => 'Low',
            2 => 'Medium',
            3 => 'High',
            4 => 'Critical',
        ];
        
        return $labels[$this->severity_level] ?? 'Not Set';
    }

    public function getPriorityLabelAttribute()
    {
        $labels = [
            1 => 'Low',
            2 => 'Medium',
            3 => 'High',
            4 => 'Urgent',
        ];
        
        return $labels[$this->priority] ?? 'Normal';
    }

    public function getIsResolvedAttribute()
    {
        return in_array($this->status, [self::STATUS_RESOLVED, self::STATUS_DISMISSED]);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeUnderReview($query)
    {
        return $query->where('status', self::STATUS_UNDER_REVIEW);
    }

    public function scopeResolved($query)
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true)
                     ->orWhere('priority', 4);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('report_type', $type);
    }

    public function scopeBySeverity($query, $severity)
    {
        return $query->where('severity_level', $severity);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    public function scopeUnassigned($query)
    {
        return $query->whereNull('assigned_to');
    }

    // Methods
    public function assignTo($userId)
    {
        $this->update([
            'assigned_to' => $userId,
            'status' => self::STATUS_UNDER_REVIEW,
        ]);
        
        return $this;
    }

    public function markAsResolved($action, $notes = null, $resolverId = null)
    {
        $this->update([
            'status' => self::STATUS_RESOLVED,
            'resolution_action' => $action,
            'resolution_notes' => $notes,
            'resolved_by' => $resolverId,
            'resolved_at' => now(),
        ]);

        // Take action based on resolution
        $this->executeResolutionAction($action);

        return $this;
    }

    public function dismissReport($notes = null, $resolverId = null)
    {
        $this->update([
            'status' => self::STATUS_DISMISSED,
            'resolution_notes' => $notes,
            'resolved_by' => $resolverId,
            'resolved_at' => now(),
        ]);

        return $this;
    }

    public function setUrgent($urgent = true)
    {
        $this->update(['is_urgent' => $urgent]);
        return $this;
    }

    public function setSeverity($level)
    {
        $this->update(['severity_level' => $level]);
        return $this;
    }

    public function setPriority($priority)
    {
        $this->update(['priority' => $priority]);
        return $this;
    }

    protected function executeResolutionAction($action)
    {
        $profile = $this->reportedProfile;
        
        switch ($action) {
            case self::ACTION_PROFILE_SUSPENSION:
                $profile->update(['is_active' => false]);
                // Add suspension record
                ProfileSuspension::create([
                    'profile_id' => $profile->id,
                    'reason' => 'Reported: ' . $this->report_type,
                    'suspended_by' => $this->resolved_by,
                    'suspended_until' => now()->addDays(7),
                    'report_id' => $this->id,
                ]);
                break;
                
            case self::ACTION_PROFILE_DELETION:
                $profile->update(['is_active' => false]);
                // Soft delete or mark for deletion
                $profile->delete();
                break;
                
            case self::ACTION_WARNING:
                // Send warning notification
                // Could implement a notification system
                break;
                
            case self::ACTION_CONTENT_REMOVAL:
                // Remove specific content
                // Implementation depends on what content needs removal
                break;
        }
    }

    // Static methods for reporting
    public static function reportProfile($reporterId, $reportedProfileId, $type, $description, $evidence = null)
    {
        $report = self::create([
            'reporter_id' => $reporterId,
            'reported_profile_id' => $reportedProfileId,
            'report_type' => $type,
            'description' => $description,
            'evidence' => $evidence,
            'status' => self::STATUS_PENDING,
            'severity_level' => self::getDefaultSeverity($type),
            'priority' => self::getDefaultPriority($type),
            'notify_reporter' => true,
        ]);

        // Increment reported count on profile
        $profile = Profile::find($reportedProfileId);
        if ($profile) {
            $profile->increment('reported_count');
        }

        return $report;
    }

    protected static function getDefaultSeverity($type)
    {
        $severityMap = [
            self::TYPE_HARASSMENT => 4,
            self::TYPE_SCAM => 4,
            self::TYPE_UNDERAGE => 4,
            self::TYPE_FAKE_PROFILE => 3,
            self::TYPE_INAPPROPRIATE_CONTENT => 3,
            self::TYPE_MISREPRESENTATION => 2,
            self::TYPE_SPAM => 2,
            self::TYPE_OTHER => 1,
        ];
        
        return $severityMap[$type] ?? 2;
    }

    protected static function getDefaultPriority($type)
    {
        $priorityMap = [
            self::TYPE_UNDERAGE => 4,
            self::TYPE_HARASSMENT => 4,
            self::TYPE_SCAM => 3,
            self::TYPE_FAKE_PROFILE => 3,
            self::TYPE_INAPPROPRIATE_CONTENT => 2,
            self::TYPE_MISREPRESENTATION => 2,
            self::TYPE_SPAM => 1,
            self::TYPE_OTHER => 1,
        ];
        
        return $priorityMap[$type] ?? 2;
    }
}