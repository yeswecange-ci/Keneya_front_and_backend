<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_main_sections', function (Blueprint $table) {
            $table->id();
            $table->string('about_title');
            $table->text('about_description_1');
            $table->text('about_description_2');
            $table->text('about_description_3');
            $table->text('about_description_4');
            $table->string('about_image_path');
            $table->string('about_button_text');
            $table->string('about_button_link');
            $table->boolean('about_is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_main_sections');
    }
};
