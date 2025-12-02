<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_unique_approach_section', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description_intro')->nullable();
            $table->text('description_middle')->nullable();
            $table->text('description_outro')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_unique_approach_section');
    }
};
