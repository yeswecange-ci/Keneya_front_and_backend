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
        Schema::create('activities_countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->unique(); // Code ISO du pays (ex: BF, CI, SN)
            $table->string('country_name'); // Nom du pays (ex: Burkina Faso)
            $table->text('description')->nullable(); // Description des activités dans ce pays
            $table->json('activities')->nullable(); // Liste des activités (JSON array)
            $table->string('image')->nullable(); // Image représentative du pays
            $table->integer('order')->default(0); // Ordre d'affichage
            $table->boolean('is_active')->default(true); // Actif ou non
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_countries');
    }
};
