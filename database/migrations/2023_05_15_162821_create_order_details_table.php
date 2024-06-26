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
        Schema::create('order_details', function (Blueprint $table) {
                $table->bigIncrements('orderdetail_id');
                $table->unsignedBigInteger('order_id');
                $table->unsignedInteger('product_id');
                $table->string('product_name');
                $table->float('product_price');
                $table->integer('product_quantity');
                $table->float('product_feeship');

                $table->foreign('order_id')
                ->references('order_id')
                ->on('orders')
                ->onDelete('cascade');



                $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
