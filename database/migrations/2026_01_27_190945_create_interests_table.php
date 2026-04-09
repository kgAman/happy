<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('profiles')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('profiles')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'blocked'])->default('pending');
            $table->text('message')->nullable();
            $table->boolean('viewed')->default(false);
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['sender_id', 'status']);
            $table->index(['receiver_id', 'status']);
            $table->index(['sender_id', 'receiver_id']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};