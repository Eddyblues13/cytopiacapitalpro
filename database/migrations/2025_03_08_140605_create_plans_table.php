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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->boolean('swap_fee')->default(false); // No Swap Fees
            $table->integer('pairs')->default(76); // Number of trading pairs
            $table->string('leverage')->nullable(); // Example: '1:500'
            $table->string('spread')->nullable(); // Example: '0.8 pips'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
