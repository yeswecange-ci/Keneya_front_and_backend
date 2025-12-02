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
        Schema::create('home_unique_approach_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('home_unique_approach_section_id');
            $table->string('item_text');
            $table->integer('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('home_unique_approach_section_id', 'hua_items_section_fk')
                ->references('id')
                ->on('home_unique_approach_section')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_unique_approach_items');
    }
};
