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
        Schema::create('activities_page_content', function (Blueprint $table) {
            $table->id();
            $table->string('activities_content_key')->unique(); // Ex: 'header_title', 'themes_section_title', etc.
            $table->text('activities_content_value');
            $table->string('activities_content_type')->default('text'); // text, url, image, etc.
            $table->text('activities_content_description')->nullable(); // Description pour l'admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_page_content');
    }
};
