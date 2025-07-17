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
        Schema::create('loa_requests', function (Blueprint $table) {
            $table->id();
            $table->string('id_article');
            $table->string('volume');
            $table->string('number');
            $table->string('month');
            $table->string('year');
            $table->string('article_title');
            $table->string('article_author');
            $table->foreignId('journal_id')->constrained('journals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loa_requests');
    }
};
