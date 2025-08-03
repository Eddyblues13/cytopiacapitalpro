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
        Schema::create('traders', function (Blueprint $table) {
            $table->id();
            $table->string('picture_url')->nullable();
            $table->string('picture_public_id')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('verified_badge')->nullable();
            $table->string('name');
            $table->decimal('return_rate', 8, 2)->default(0.00);
            $table->decimal('min_amount', 15, 2);
            $table->decimal('max_amount', 15, 2);
            $table->integer('followers')->default(0); 
            $table->decimal('profit_share', 5, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traders');
    }
};
