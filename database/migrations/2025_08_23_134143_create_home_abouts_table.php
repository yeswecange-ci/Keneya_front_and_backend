<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_about', function (Blueprint $table) {
            $table->id();
            $table->string('home_about_section_title');
            $table->string('home_about_main_title');
            $table->text('home_about_description');
            $table->string('home_about_button_text');
            $table->string('home_about_button_link');
            $table->boolean('home_about_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_about');
    }
};
