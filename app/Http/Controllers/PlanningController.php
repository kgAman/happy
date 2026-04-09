<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanningController extends Controller
{
    /**
     * Display the main planning page.
     */
    public function index()
    {
        return view('pages.planning.index');
    }

    /**
     * Display the wedding checklist page.
     */
    public function checklist()
    {
        // Checklist data structure
        $checklistData = [
            'sections' => [
                [
                    'title' => '12-18 Months Before: Engagement & Vision',
                    'icon' => 'bi-calendar-heart',
                    'tasks' => [
                        [
                            'id' => 'task1',
                            'title' => 'Announce Your Engagement',
                            'description' => 'Share the happy news with family and friends. Consider engagement photos for announcements.',
                            'priority' => 'high',
                            'timing' => 'Months 12-18'
                        ],
                        [
                            'id' => 'task2',
                            'title' => 'Determine Your Budget',
                            'description' => 'Discuss with family about contributions and set a realistic overall budget.',
                            'priority' => 'high',
                            'timing' => 'Months 12-18'
                        ],
                        // Add more tasks...
                    ]
                ],
                // Add more sections...
            ],
            'timeline' => [
                [
                    'timeframe' => '12-18 Months Before',
                    'title' => 'Vision & Budget',
                    'description' => 'Set your budget, determine guest count, and start envisioning your perfect day.',
                    'icon' => 'bi-heart'
                ],
                // Add more timeline items...
            ],
            'tips' => [
                [
                    'title' => 'Budget Smartly',
                    'description' => 'Allocate 50% of your budget to venue, catering, and rentals. Save 5-10% for unexpected expenses.',
                    'icon' => 'bi-currency-dollar',
                    'tags' => ['Budget', 'Planning']
                ],
                // Add more tips...
            ]
        ];

        return view('pages.planning.checklist', $checklistData);
    }

    /**
     * Display the budget calculator page.
     */
    public function budget()
    {
        return view('pages.planning.budget');
    }

    /**
     * Display the guest list manager page.
     */
    public function guestList()
    {
        return view('pages.planning.guest-list');
    }

    /**
     * Display the timeline planner page.
     */
    public function timeline()
    {
        return view('pages.planning.timeline');
    }

    /**
     * Display the vendor checklist page.
     */
    public function vendorChecklist()
    {
        return view('pages.planning.vendor-checklist');
    }

    /**
     * Save checklist progress (AJAX endpoint).
     */
    public function saveChecklistProgress(Request $request)
    {
        $request->validate([
            'progress' => 'required|array',
            'user_id' => 'nullable|integer'
        ]);

        // In a real application, you would save to database
        // For now, we'll just return success
        
        return response()->json([
            'success' => true,
            'message' => 'Checklist progress saved successfully!',
            'saved_at' => now()->toDateTimeString()
        ]);
    }

    /**
     * Export checklist as PDF.
     */
    public function exportChecklistPdf()
    {
        // In a real application, you would generate a PDF
        // For now, return a placeholder response
        
        return response()->json([
            'success' => true,
            'message' => 'PDF export feature coming soon!',
            'download_url' => '#'
        ]);
    }
}