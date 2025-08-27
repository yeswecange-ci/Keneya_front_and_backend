<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_slides', function (Blueprint $table) {
            $table->id();
            $table->string('home_slide_number');
            $table->string('home_slide_title');
            $table->text('home_slide_description');
            $table->string('home_slide_image');
            $table->integer('home_slide_order')->default(1);
            $table->boolean('home_slide_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_slides');
    }
};
