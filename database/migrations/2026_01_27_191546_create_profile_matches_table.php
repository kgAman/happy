<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile1_id')->constrained('profiles')->onDelete('cascade');
            $table->foreignId('profile2_id')->constrained('profiles')->onDelete('cascade');
            $table->integer('match_score')->default(0);
            $table->json('score_details')->nullable();
            $table->boolean('mutual_interest')->default(false);
            $table->boolean('is_compatible')->default(false);
            $table->timestamp('last_calculated_at')->nullable();
            $table->timestamps();
            
            // Ensure unique pair
            $table->unique(['profile1_id', 'profile2_id']);
            
            // Indexes
            $table->index(['profile1_id', 'match_score']);
            $table->index(['profile2_id', 'match_score']);
            $table->index('match_score');
            $table->index('mutual_interest');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_matches');
    }
};