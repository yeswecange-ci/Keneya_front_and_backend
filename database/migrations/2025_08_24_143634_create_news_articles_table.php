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
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('news_title');
            $table->text('news_description');
            $table->string('news_image')->nullable();
            $table->string('news_link')->nullable();
            $table->enum('news_type', ['blog', 'event', 'publication', 'press_release']);
            $table->boolean('news_is_active')->default(true);
            $table->integer('news_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
