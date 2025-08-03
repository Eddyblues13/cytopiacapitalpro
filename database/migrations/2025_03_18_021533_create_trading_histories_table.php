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
        Schema::create('trading_histories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('trader_id'); // Foreign key to traders table
            $table->decimal('amount', 10, 2); // Amount used for the trade
            $table->string('status')->default('pending'); // Status of the trade
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('trader_id')->references('id')->on('traders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_histories');
    }
};
