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
        Schema::create('activities_services', function (Blueprint $table) {
            $table->id();
            $table->string('activities_service_number'); // 01, 02, 03...
            $table->string('activities_service_title');
            $table->json('activities_service_features'); // Les points de la liste
            $table->string('activities_service_image')->nullable();
            $table->integer('activities_service_order')->default(0);
            $table->boolean('activities_service_is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_services');
    }
};
