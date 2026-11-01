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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('stock_name');
            $table->string('picture')->nullable(); // path in public/uploads/stocks
            $table->decimal('stock_min_amount', 15, 2);
            $table->decimal('stock_max_amount', 15, 2);
            $table->text('stock_js')->nullable(); // chart widget script
            $table->text('stock_graph')->nullable();
            $table->decimal('top_up_amount', 15, 2)->nullable();
            $table->string('top_up_interval')->nullable();
            $table->string('top_up_type')->nullable();
            $table->string('top_up_status')->nullable();
            $table->integer('investment_duration')->nullable();
            $table->string('performance')->nullable();
            $table->decimal('copier_roi', 8, 2)->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
