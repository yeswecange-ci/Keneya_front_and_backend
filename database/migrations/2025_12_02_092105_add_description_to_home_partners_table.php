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
        Schema::table('home_partners', function (Blueprint $table) {
            $table->text('home_partner_description')->nullable()->after('home_partner_section_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_partners', function (Blueprint $table) {
            $table->dropColumn('home_partner_description');
        });
    }
};
