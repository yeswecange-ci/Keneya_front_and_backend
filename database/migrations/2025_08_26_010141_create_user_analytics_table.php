<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();
            $table->string('user_agent')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('device_type')->nullable(); // desktop, mobile, tablet
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('referrer')->nullable();
            $table->string('landing_page')->nullable();
            $table->json('pages_visited')->nullable();
            $table->integer('session_duration')->default(0); // en secondes
            $table->timestamp('first_visit_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->boolean('cookies_accepted')->default(false);
            $table->timestamp('cookies_accepted_at')->nullable();
            $table->timestamps();

            $table->index(['session_id', 'cookies_accepted']);
            $table->index('cookies_accepted_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_analytics');
    }
};
