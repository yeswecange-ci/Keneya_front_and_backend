<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_recruitment', function (Blueprint $table) {
            $table->id();
            $table->string('home_recruitment_section_title');
            $table->text('home_recruitment_description');
            $table->boolean('home_recruitment_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_recruitment');
    }
};
