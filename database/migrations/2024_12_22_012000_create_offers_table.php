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
        Schema::create('offers', function (Blueprint $table) {
            $table->id(); 
            $table->enum('discount_type', ['percentage', 'fixed']);  // نوع الخصم (نسبة أو ثابت)
            $table->decimal('discount_value', 10, 2);  // قيمة الخصم
            $table->dateTime('start_date');  // تاريخ بداية العرض
            $table->dateTime('end_date');  // تاريخ نهاية العرض
            $table->tinyInteger('status')->default(1);  // حالة العرض
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
