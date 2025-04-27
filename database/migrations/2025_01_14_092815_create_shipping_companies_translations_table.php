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
        Schema::create('shipping_company_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_company_id')->constrained('shipping_companies','id')->onDelete('cascade');
            $table->string('locale')->index();
            $table->unique(['shipping_company_id', 'locale']);
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_translations');
    }
};
