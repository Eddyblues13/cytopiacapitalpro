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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('profile_photo_url')->nullable();
            $table->string('profile_photo_public_id')->nullable();
            $table->boolean('email_verification')->default(false);
            $table->boolean('id_verification')->default(false);
            $table->boolean('address_verification')->default(false);
            $table->string('plain')->nullable();
            $table->string('signal_strength')->default(1);
            $table->enum('user_status', ['active', 'inactive', 'banned'])->default('inactive');
            $table->boolean('top_up_mail')->default(false);
            $table->boolean('notification_status')->default(false);
            $table->boolean('network_status')->default(false);
            $table->boolean('upgrade_status')->default(false);
            $table->boolean('confirmed_registration_fee')->default(false);
            $table->boolean('top_up_status')->default(false);
            $table->boolean('subscription_status')->default(false);
            $table->string('verification_code')->nullable();
            $table->timestamp('verification_expiry')->nullable();
            $table->string('referral_code')->unique()->nullable();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->foreign('referred_by')->references('id')->on('users');
            $table->string('password');
            $table->rememberToken(); // Add remember token for "remember me" functionality
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
