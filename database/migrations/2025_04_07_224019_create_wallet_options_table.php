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
        Schema::create('wallet_options', function (Blueprint $table) {
            $table->id();
            $table->string('coin_code')->nullable(); // e.g., BTC
            $table->string('coin_name')->nullable(); // e.g., Bitcoin
            $table->string('wallet_name')->nullable(); // e.g., My BTC Wallet
            $table->string('wallet_type')->nullable(); // e.g., Hot, Cold, etc.
            $table->string('icon')->nullable(); // path or URL to icon
            $table->string('wallet_address')->nullable(); // actual crypto address
            $table->string('network_type')->nullable(); // e.g., ERC20, TRC20, BEP20
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_options');
    }
};
