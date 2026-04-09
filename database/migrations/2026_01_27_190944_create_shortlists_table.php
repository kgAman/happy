<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shortlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->integer('match_score')->nullable();
            $table->boolean('notify_me')->default(true);
            $table->enum('status', ['active', 'archived'])->default('active');
            $table->timestamps();
            
            // Ensure unique combination
            $table->unique(['user_id', 'profile_id']);
            
            // Indexes
            $table->index(['user_id', 'created_at']);
            $table->index(['profile_id', 'created_at']);
            $table->index('match_score');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shortlists');
    }
};