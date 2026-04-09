<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('viewer_id')->nullable()->constrained('profiles')->onDelete('set null');
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->boolean('is_premium_viewer')->default(false);
            $table->timestamp('viewed_at')->useCurrent();
            
            // Indexes
            $table->index(['profile_id', 'viewed_at']);
            $table->index(['viewer_id', 'profile_id']);
            $table->index('viewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_views');
    }
};