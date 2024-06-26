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
        Schema::create('shippings', function (Blueprint $table) {
                $table->Increments('id');
                $table->string('shipping_name');
                $table->string('shipping_address');
                $table->string('shipping_dictrictId');
                $table->string('shipping_wardId');
                $table->string('shipping_phone');
                $table->string('shipping_email');
                $table->string('shipping_method');
                $table->string('shipping_address_street');
                $table->string('shipping_notes')->nullable();



                $table->unsignedInteger('user_id');
                $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
