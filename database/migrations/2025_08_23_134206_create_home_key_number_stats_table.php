<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_key_number_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_key_number_id')->constrained('home_key_numbers')->onDelete('cascade');
            $table->string('home_stat_icon');
            $table->integer('home_stat_number');
            $table->string('home_stat_description');
            $table->integer('home_stat_order')->default(1);
            $table->boolean('home_stat_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_key_number_stats');
    }
};
