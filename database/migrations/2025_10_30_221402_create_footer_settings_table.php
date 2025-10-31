<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('footer_logo1')->nullable();
            $table->string('footer_logo2')->nullable();
            $table->string('footer_copyright')->default('KENAYAIMPACT 2025');
            $table->string('footer_legal_link')->default('#');
            $table->string('footer_legal_text')->default('MENTION LÉGALES');
            $table->timestamps();
        });

        Schema::create('footer_columns', function (Blueprint $table) {
            $table->id();
            $table->string('column_title');
            $table->integer('column_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('footer_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('footer_column_id')->constrained()->onDelete('cascade');
            $table->string('link_text');
            $table->string('link_url')->default('#');
            $table->integer('link_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('footer_socials', function (Blueprint $table) {
            $table->id();
            $table->string('social_platform');
            $table->string('social_url')->default('#');
            $table->string('social_icon');
            $table->integer('social_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('footer_socials');
        Schema::dropIfExists('footer_links');
        Schema::dropIfExists('footer_columns');
        Schema::dropIfExists('footer_settings');
    }
};
