<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_transition_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_transition_section_id')->constrained('about_transition_sections')->onDelete('cascade');
            $table->text('about_transition_list_content');
            $table->integer('about_transition_list_order')->default(1);
            $table->boolean('about_transition_list_is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_transition_list_items');
    }
};
