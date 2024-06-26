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
        Schema::create('statisproducts', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('sales_count')->nullable();
            $table->integer('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statisproducts');
    }
};
