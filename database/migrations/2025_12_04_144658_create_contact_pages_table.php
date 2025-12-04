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
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('text_above_image_fr')->nullable();
            $table->text('text_above_image_en')->nullable();
            $table->text('text_above_image_es')->nullable();
            $table->text('location_url')->nullable();
            $table->string('location_text_fr')->nullable();
            $table->string('location_text_en')->nullable();
            $table->string('location_text_es')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
