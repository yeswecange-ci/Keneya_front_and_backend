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
        Schema::create('activities_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('activities_testimonial_title');
            $table->text('activities_testimonial_description');
            $table->string('activities_testimonial_image')->nullable();
            $table->string('activities_testimonial_link')->nullable(); // Pour le lien du témoignage
            $table->integer('activities_testimonial_order')->default(0);
            $table->boolean('activities_testimonial_is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_testimonials');
    }
};
