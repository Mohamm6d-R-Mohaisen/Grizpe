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
        Schema::create('home_section_items', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('home_section_id')->constrained('home_sections','id')->onDelete('cascade')->name('hme_s_id');            
            $table->string('image')->nullable(); // صورة العنصر
            $table->string('link')->nullable(); // رابط العنصر
            $table->integer('order')->default(0); // ترتيب العنصر داخل القسم
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_section_items');
    }
};
