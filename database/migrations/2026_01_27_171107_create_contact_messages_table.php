<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('wedding_date')->nullable();
            $table->enum('inquiry_type', ['planning', 'vendor', 'inspiration', 'website', 'other']);
            $table->text('message');
            $table->boolean('subscribe_newsletter')->default(false);
            $table->string('ip_address')->nullable();
            $table->enum('status', ['pending', 'read', 'replied', 'archived'])->default('pending');
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};