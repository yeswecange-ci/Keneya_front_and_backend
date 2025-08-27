<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_accordion_items', function (Blueprint $table) {
            $table->id();
            $table->string('about_accordion_title');
            $table->text('about_accordion_content');
            $table->integer('about_accordion_order')->default(1);
            $table->boolean('about_accordion_is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_accordion_items');
    }
};
