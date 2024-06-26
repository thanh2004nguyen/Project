<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('orderdetail_id');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->text('admin_comment')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
            ->references('product_id')
            ->on('products')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('orderdetail_id')
            ->references('orderdetail_id')
            ->on('order_details')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
