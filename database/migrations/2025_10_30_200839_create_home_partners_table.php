<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_partners', function (Blueprint $table) {
            $table->id();
            $table->string('home_partner_section_title')->default('ILS NOUS FONT CONFIANCE');
            $table->boolean('home_partner_active')->default(true);
            $table->timestamps();
        });

        Schema::create('home_partner_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_partner_id')->constrained()->onDelete('cascade');
            $table->string('home_partner_item_image');
            $table->string('home_partner_item_alt')->nullable();
            $table->integer('home_partner_item_order')->default(0);
            $table->boolean('home_partner_item_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_partner_items');
        Schema::dropIfExists('home_partners');
    }
};
