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
        Schema::create('bloge_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloge_id')->constrained('bloges','id')->onDelete('cascade');
            $table->string('title');
            $table->string('author_name');
            $table->text('content');
            $table->text('quotation');
            $table->text('lessons');
            $table->text('conclusions');
            $table->text('short_description');
            $table->string('locale')->index();
            $table->unique(['bloge_id','locale']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloge_translations');
    }
};
