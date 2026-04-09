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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_login_ip')->nullable()->after('remember_token');
            $table->string('phone', 20)->nullable()->after('remember_token');
            $table->boolean('is_active')->default(true)->after('remember_token');
            $table->string('profile_type')->nullable()->comment('bride/groom/parent')->after('remember_token');
            $table->string('avatar')->nullable()->after('remember_token');
            $table->json('settings')->nullable()->after('remember_token');
            
            $table->softDeletes();
            
            // Indexes
            $table->index('email');
            $table->index('is_active');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
