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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->longText('thumbnail')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_free')->default(true);
            $table->string('published_day')->nullable();
            $table->date('created')->default(now());
            $table->bigInteger('views')->default(0);
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
