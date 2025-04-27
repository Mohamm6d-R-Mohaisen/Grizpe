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
        Schema::create('work_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works', 'id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->unique(['work_id', 'locale']);
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->text('overview');
            $table->string('client_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_translations');
    }
};
