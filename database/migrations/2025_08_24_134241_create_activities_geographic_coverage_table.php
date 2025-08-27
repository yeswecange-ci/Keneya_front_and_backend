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
        Schema::create('activities_geographic_coverage', function (Blueprint $table) {
            $table->id();
            $table->string('activities_geographic_title');
            $table->text('activities_geographic_description');
            $table->text('activities_geographic_map_svg')->nullable(); // Pour stocker le SVG de la carte
            $table->boolean('activities_geographic_is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_geographic_coverage');
    }
};
