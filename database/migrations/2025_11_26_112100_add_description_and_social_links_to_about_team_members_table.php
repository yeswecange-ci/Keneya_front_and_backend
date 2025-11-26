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
        Schema::table('about_team_members', function (Blueprint $table) {
            $table->text('about_team_description')->nullable()->after('about_team_position');
            $table->string('about_team_facebook')->nullable()->after('about_team_description');
            $table->string('about_team_twitter')->nullable()->after('about_team_facebook');
            $table->string('about_team_linkedin')->nullable()->after('about_team_twitter');
            $table->string('about_team_instagram')->nullable()->after('about_team_linkedin');
            $table->string('about_team_github')->nullable()->after('about_team_instagram');
            $table->dropColumn('about_team_detail_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_team_members', function (Blueprint $table) {
            $table->dropColumn([
                'about_team_description',
                'about_team_facebook',
                'about_team_twitter',
                'about_team_linkedin',
                'about_team_instagram',
                'about_team_github'
            ]);
            $table->string('about_team_detail_link')->nullable();
        });
    }
};
