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
        Schema::create('home_section_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_section_id')->constrained('home_sections','id')->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['home_section_id', 'locale']);
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
        Schema::dropIfExists('home_section_translations');
    }
};
