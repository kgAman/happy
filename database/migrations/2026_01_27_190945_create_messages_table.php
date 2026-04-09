<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('profiles')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('profiles')->onDelete('cascade');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_delivered')->default(false);
            $table->timestamp('delivered_at')->nullable();
            $table->json('attachments')->nullable();
            $table->enum('message_type', ['text', 'image', 'document', 'audio', 'video'])->default('text');
            $table->boolean('is_deleted_by_sender')->default(false);
            $table->boolean('is_deleted_by_receiver')->default(false);
            $table->timestamps();
            
            // Indexes
            $table->index(['sender_id', 'receiver_id', 'created_at']);
            $table->index(['receiver_id', 'is_read']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};