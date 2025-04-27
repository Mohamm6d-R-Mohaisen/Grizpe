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
        Schema::create('home_section_item_translations', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('home_section_item_id')->constrained('home_section_items','id')->onDelete('cascade')->name('hme_s_i_id');
            $table->unique(['home_section_item_id', 'locale'],'hme_s_i_id_locale_unq');
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_section_item_translations');
    }
};
