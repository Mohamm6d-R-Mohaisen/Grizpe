<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users','id')->onDelete('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons','id')->onDelete('cascade');
            $table->decimal('subtotal', 10, 2); // مجموع السعر قبل الخصومات
            $table->decimal('discount', 10, 2)->default(0.00); // قيمة الخصم
            $table->decimal('shipping_cost', 10, 2)->default(0); // المجموع النهائي
            $table->decimal('total', 10, 2); // المجموع النهائي
            $table->enum('status' , ['paided', 'pending' , 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }
};
