<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Columns the controllers and views already read or write but no migration created.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Full name computed by the database; admin pages select and search users.name
            $table->string('name', 511)->virtualAs("CONCAT(first_name, ' ', last_name)")->after('last_name');
            $table->string('kyc_status')->default('0')->after('address_verification'); // 0 not verified, 1 verified, 2 declined
            $table->boolean('account_suspended')->default(false)->after('user_status');
        });

        Schema::table('deposits', function (Blueprint $table) {
            // Express deposits credited from the admin user page have no account type
            $table->string('account_type')->nullable()->change();
            $table->string('deposit_type')->nullable()->after('account_type');
            $table->string('payment_mode')->nullable()->after('deposit_type');
            $table->string('proof')->nullable()->after('payment_mode');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->string('withdrawal_method')->nullable()->after('account_type'); // crypto, bank
            $table->string('currency', 10)->nullable()->after('amount');
            $table->decimal('fee', 20, 8)->default(0)->after('currency');
            $table->json('bank_details')->nullable()->after('wallet_address');
        });

        Schema::table('wallet_options', function (Blueprint $table) {
            $table->string('status')->default('enabled')->after('network_type'); // enabled, disabled
        });

        Schema::table('identity_verifications', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable()->after('status');
            $table->timestamp('verified_at')->nullable()->after('admin_id');
        });

        Schema::table('contact_infos', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable()->after('utility_bill_public_id');
        });

        Schema::table('trading_histories', function (Blueprint $table) {
            $table->timestamp('closed_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trading_histories', function (Blueprint $table) {
            $table->dropColumn('closed_at');
        });

        Schema::table('contact_infos', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });

        Schema::table('identity_verifications', function (Blueprint $table) {
            $table->dropColumn(['admin_id', 'verified_at']);
        });

        Schema::table('wallet_options', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn(['withdrawal_method', 'currency', 'fee', 'bank_details']);
        });

        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn(['deposit_type', 'payment_mode', 'proof']);
            $table->string('account_type')->nullable(false)->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'kyc_status', 'account_suspended']);
        });
    }
};
