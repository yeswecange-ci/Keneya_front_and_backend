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
        Schema::table('activities_services', function (Blueprint $table) {
            $table->text('activities_service_description')->nullable()->after('activities_service_features');
            $table->string('activities_service_pdf_path')->nullable()->after('activities_service_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities_services', function (Blueprint $table) {
            $table->dropColumn(['activities_service_description', 'activities_service_pdf_path']);
        });
    }
};
