<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activities_key_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('activities_keynumber_title');
            $table->integer('activities_keynumber_value');
            $table->string('activities_keynumber_icon')->nullable();
            $table->text('activities_keynumber_description')->nullable();
            $table->integer('activities_keynumber_order')->default(0);
            $table->boolean('activities_keynumber_is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities_key_numbers');
    }
};