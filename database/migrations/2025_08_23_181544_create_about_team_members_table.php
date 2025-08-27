<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_team_members', function (Blueprint $table) {
            $table->id();
            $table->string('about_team_name');
            $table->string('about_team_position');
            $table->string('about_team_image_path');
            $table->string('about_team_detail_link')->nullable();
            $table->integer('about_team_order')->default(1);
            $table->boolean('about_team_is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_team_members');
    }
};
