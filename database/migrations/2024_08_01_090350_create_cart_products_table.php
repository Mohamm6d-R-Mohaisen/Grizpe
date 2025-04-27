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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts','id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products','id')->onDelete('cascade');
            $table->integer('quantity')->default(1); // الكمية
            $table->decimal('price', 10, 2); // سعر المنتج وقت الإضافة
            $table->decimal('total_price', 10, 2); // مجموع السعر للكمية
            $table->json('attribute_values')->nullable(); // سمات المنتج (مثل اللون أو الحجم)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
