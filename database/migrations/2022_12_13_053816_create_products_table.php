<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');

            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('provider_id');
            $table->timestamps();
            $table->foreign('provider_id')->references('provider_id')->on('providers');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->integer('quantity')->nullable();
            $table->integer('sales_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
