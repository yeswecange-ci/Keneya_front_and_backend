<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_applications', function (Blueprint $table) {
            $table->id();
            $table->string('home_application_first_name');
            $table->string('home_application_last_name');
            $table->string('home_application_email');
            $table->string('home_application_phone');
            $table->string('home_application_desired_position');
            $table->date('home_application_availability_date');
            $table->string('home_application_cv_path')->nullable();
            $table->enum('home_application_status', ['pending', 'reviewed', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_applications');
    }
};
