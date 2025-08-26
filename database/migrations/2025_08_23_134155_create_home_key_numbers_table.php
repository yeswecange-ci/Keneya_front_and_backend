<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_key_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('home_key_numbers_section_title');
            $table->text('home_key_numbers_description');
            $table->string('home_key_numbers_image');
            $table->string('home_key_numbers_button_text');
            $table->string('home_key_numbers_button_link');
            $table->boolean('home_key_numbers_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_key_numbers');
    }
};
