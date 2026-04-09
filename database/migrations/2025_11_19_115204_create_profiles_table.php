<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            // Primary Key
            $table->id();
            
            // ===== BASIC INFORMATION =====
            $table->string('title', 10)->nullable()->comment('Mr/Mrs/Ms/Dr');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('full_name', 300)->nullable();
            $table->string('country_code', 5)->default('+91');
            $table->string('mobile', 15);
            $table->string('alternate_mobile', 15)->nullable();
            $table->string('email', 150)->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->string('highest_qualification', 200)->nullable();
            $table->string('other_qualification', 200)->nullable();
            $table->string('institution_name', 200)->nullable();
            
            // ===== ADDRESS =====
            $table->string('house_no', 50)->nullable();
            $table->string('colony', 200)->nullable();
            $table->string('street', 200)->nullable();
            $table->string('landmark', 200)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('taluka', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->default('India');
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('native_place', 200)->nullable();
            
            // ===== BIRTH & PHYSICAL =====
            $table->date('dob')->nullable();
            $table->string('tob', 10)->nullable()->comment('Time of Birth');
            $table->string('birth_place', 200)->nullable();
            $table->integer('age')->nullable();
            $table->decimal('height_cm', 5, 2)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->enum('complexion', ['very_fair', 'fair', 'wheatish', 'dark'])->nullable();
            $table->enum('body_type', ['slim', 'average', 'athletic', 'heavy'])->nullable();
            $table->enum('physical_status', ['normal', 'physically_challenged'])->default('normal');
            $table->json('hobbies')->nullable();
            $table->json('interests')->nullable();
            
            // ===== MARITAL STATUS =====
            $table->enum('marital_status', ['never_married', 'divorced', 'widowed', 'separated', 'awaiting_divorce'])->default('never_married');
            $table->integer('children')->default(0);
            $table->enum('children_living_with', ['self', 'partner', 'joint'])->nullable();
            $table->text('divorce_details')->nullable();
            $table->text('widow_widower_details')->nullable();
            
            // ===== PERSONAL & HOROSCOPE =====
            $table->enum('mangal_dosh', ['yes', 'no', 'not_sure'])->nullable();
            $table->string('nakshatra', 50)->nullable();
            $table->string('rashi', 50)->nullable();
            $table->string('charan', 50)->nullable();
            $table->string('gan', 50)->nullable();
            $table->string('nadi', 50)->nullable();
            $table->string('gotra', 100)->nullable();
            $table->enum('diet', ['vegetarian', 'non_vegetarian', 'eggetarian', 'vegan'])->nullable();
            $table->enum('drinking_habits', ['never', 'occasionally', 'regularly'])->nullable();
            $table->enum('smoking_habits', ['never', 'occasionally', 'regularly'])->nullable();
            $table->text('about_myself')->nullable();
            $table->text('family_values')->nullable();
            
            // ===== PROFESSIONAL =====
            $table->string('occupation', 200)->nullable();
            $table->string('designation', 200)->nullable();
            $table->string('company_name', 200)->nullable();
            $table->string('industry', 200)->nullable();
            $table->enum('job_type', ['government', 'private', 'business', 'not_working', 'student'])->nullable();
            $table->string('business_type', 200)->nullable();
            $table->decimal('annual_income', 12, 2)->nullable();
            $table->decimal('self_income', 12, 2)->nullable();
            $table->decimal('family_income', 12, 2)->nullable();
            $table->text('property_details')->nullable();
            $table->text('vehicle_details')->nullable();
            $table->decimal('budget_demand', 12, 2)->nullable();
            
            // ===== RELIGION & COMMUNITY =====
            $table->string('religion', 100)->nullable();
            $table->string('caste', 100)->nullable();
            $table->string('sub_caste', 100)->nullable();
            $table->string('mother_tongue', 100)->nullable();
            $table->json('languages_known')->nullable();
            $table->string('ethnicity', 100)->nullable();
            $table->string('community', 100)->nullable();
            
            // ===== FAMILY BACKGROUND =====
            $table->string('father_first', 100)->nullable();
            $table->string('father_middle', 100)->nullable();
            $table->string('father_last', 100)->nullable();
            $table->string('father_occupation', 200)->nullable();
            $table->boolean('father_alive')->default(true);
            $table->string('mother_first', 100)->nullable();
            $table->string('mother_middle', 100)->nullable();
            $table->string('mother_last', 100)->nullable();
            $table->string('mother_occupation', 200)->nullable();
            $table->boolean('mother_alive')->default(true);
            $table->enum('family_type', ['joint', 'nuclear', 'extended'])->nullable();
            $table->enum('family_status', ['lower_middle', 'middle', 'upper_middle', 'rich', 'affluent'])->nullable();
            $table->integer('no_of_brothers')->default(0);
            $table->integer('no_of_sisters')->default(0);
            $table->integer('married_brothers')->default(0);
            $table->integer('married_sisters')->default(0);
            $table->string('family_location', 200)->nullable();
            
            // ===== PARTNER PREFERENCES =====
            $table->integer('partner_min_age')->nullable();
            $table->integer('partner_max_age')->nullable();
            $table->decimal('partner_min_height', 5, 2)->nullable();
            $table->decimal('partner_max_height', 5, 2)->nullable();
            $table->string('partner_religion', 100)->nullable();
            $table->string('partner_caste', 100)->nullable();
            $table->string('partner_sub_caste', 100)->nullable();
            $table->string('partner_qualification', 200)->nullable();
            $table->string('partner_occupation', 200)->nullable();
            $table->decimal('partner_income', 12, 2)->nullable();
            $table->string('partner_country', 100)->nullable();
            $table->string('partner_state', 100)->nullable();
            $table->string('partner_city', 100)->nullable();
            $table->string('partner_location', 200)->nullable();
            $table->enum('partner_marital_status', ['never_married', 'divorced', 'widowed', 'separated', 'any'])->nullable();
            $table->enum('partner_mangal_dosh', ['yes', 'no', 'not_sure', 'any'])->nullable();
            $table->enum('partner_diet', ['vegetarian', 'non_vegetarian', 'eggetarian', 'vegan', 'any'])->nullable();
            $table->enum('partner_complexion', ['very_fair', 'fair', 'wheatish', 'dark', 'any'])->nullable();
            $table->enum('partner_physical_status', ['normal', 'physically_challenged', 'any'])->nullable();
            $table->text('partner_family_background')->nullable();
            $table->text('partner_description')->nullable();
            $table->boolean('caste_barrier')->default(false);
            $table->decimal('partner_budget_demand', 12, 2)->nullable();
            $table->boolean('horoscope')->default(false);
            $table->json('area_preference')->nullable();
            $table->text('other_preferences')->nullable();
            
            // ===== MEDIA =====
            $table->string('profile_photo', 255)->nullable();
            $table->boolean('profile_photo_verified')->default(false);
            $table->json('self_images')->nullable();
            $table->string('horoscope_image', 255)->nullable();
            $table->json('family_images')->nullable();
            $table->string('video_profile', 255)->nullable();
            
            // ===== SYSTEM & STATUS =====
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('profile_id', 20)->unique();
            $table->integer('profile_completion')->default(0);
            $table->integer('profile_views')->default(0);
            $table->integer('shortlisted_count')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->enum('verification_level', ['basic', 'verified', 'premium'])->default('basic');
            $table->timestamp('verification_date')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->timestamp('premium_expiry')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_login')->nullable();
            $table->enum('profile_created_by', ['self', 'parent', 'relative', 'friend'])->default('self');
            $table->integer('match_score')->default(0);
            $table->json('privacy_settings')->nullable();
            $table->enum('contact_visibility', ['all', 'premium', 'verified', 'none'])->default('premium');
            $table->enum('photo_visibility', ['all', 'premium', 'verified', 'none'])->default('premium');
            $table->enum('horoscope_visibility', ['all', 'premium', 'verified', 'none'])->default('verified');
            
            // ===== REGISTRATION DETAILS =====
            $table->enum('registered_by', ['self', 'parent', 'brother', 'sister', 'relative'])->default('self');
            $table->timestamp('registration_date')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->enum('membership_type', ['free', 'basic', 'premium', 'vip'])->default('free');
            $table->timestamp('membership_expiry')->nullable();
            
            // ===== ADDITIONAL DETAILS =====
            $table->text('expectations_from_partner')->nullable();
            $table->text('about_family')->nullable();
            $table->text('hobbies_interests')->nullable();
            $table->text('career_ambitions')->nullable();
            $table->text('religious_beliefs')->nullable();
            $table->text('lifestyle')->nullable();
            $table->text('personality_traits')->nullable();
            $table->text('health_information')->nullable();
            $table->json('education_details')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('skills')->nullable();
            $table->json('achievements')->nullable();
            $table->json('travel_history')->nullable();
            $table->text('settlement_plans')->nullable();
            
            // ===== CONTACT PREFERENCES =====
            $table->json('contact_preference')->nullable();
            $table->string('contact_timings', 100)->nullable();
            $table->enum('contact_through', ['self', 'father', 'mother', 'brother', 'sister', 'relative'])->default('self');
            $table->boolean('allow_direct_contact')->default(false);
            
            // ===== ADMIN FIELDS =====
            $table->text('admin_notes')->nullable();
            $table->integer('admin_rating')->default(0);
            $table->integer('profile_score')->default(0);
            $table->integer('reported_count')->default(0);
            $table->integer('blocked_count')->default(0);
            $table->text('rejection_reason')->nullable();
            $table->enum('approval_status', ['pending', 'approved', 'rejected', 'under_review'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_date')->nullable();
            
            // ===== TIMESTAMPS =====
            $table->timestamps();
            $table->softDeletes();
            
            // ===== INDEXES =====
            $table->index('user_id');
            $table->index('profile_id');
            $table->index('mobile');
            $table->index('email');
            $table->index('gender');
            $table->index('dob');
            $table->index('age');
            $table->index('marital_status');
            $table->index('religion');
            $table->index('caste');
            $table->index('occupation');
            $table->index('annual_income');
            $table->index('city');
            $table->index('state');
            $table->index('country');
            $table->index('is_verified');
            $table->index('is_premium');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('verification_level');
            $table->index('membership_type');
            $table->index('approval_status');
            $table->index('profile_completion');
            $table->index('match_score');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};