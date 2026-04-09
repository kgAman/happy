<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('profiles')->onDelete('cascade');
            $table->foreignId('reported_profile_id')->constrained('profiles')->onDelete('cascade');
            $table->enum('report_type', ['fake_profile', 'inappropriate_content', 'harassment', 'spam', 'other']);
            $table->text('description');
            $table->json('evidence')->nullable();
            $table->enum('status', ['pending', 'under_review', 'resolved', 'dismissed'])->default('pending');
            $table->foreignId('resolved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('resolution_notes')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['reported_profile_id', 'status']);
            $table->index(['reporter_id', 'created_at']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_reports');
    }
};