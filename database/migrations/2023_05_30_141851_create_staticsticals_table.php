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
        Schema::create('staticsticals', function (Blueprint $table) {
            $table->id();
            $table->date('order_date')->nullable();
            $table->decimal('sales', 10, 2)->nullable();
            $table->decimal('profit', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('total_order')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staticsticals');
    }
};
