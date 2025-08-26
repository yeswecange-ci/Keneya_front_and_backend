<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_transition_sections', function (Blueprint $table) {
            $table->id();
            $table->string('about_transition_title');
            $table->text('about_transition_description_1');
            $table->text('about_transition_description_2');
            $table->string('about_transition_image_path');
            $table->boolean('about_transition_is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_transition_sections');
    }
};
