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
        Schema::create('plane_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plane_id')->constrained('planes','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unique(['plane_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plane_translations');
    }
};
