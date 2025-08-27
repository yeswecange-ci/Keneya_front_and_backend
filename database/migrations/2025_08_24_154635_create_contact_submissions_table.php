<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('desired_position')->nullable();
            $table->date('availability_date')->nullable();
            $table->string('cv_path')->nullable();
            $table->text('message')->nullable();
            $table->string('type'); // 'application' ou 'quote'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_submissions');
    }
};
