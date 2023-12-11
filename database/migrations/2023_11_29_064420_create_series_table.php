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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_id');
            $table->bigInteger('views')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->string('original_title')->nullable();
            $table->longText('overview')->nullable();
            $table->enum('status', ['finish', 'ongoing', 'pending'])->nullable();
            $table->date('created')->default(now());
            $table->string('tag')->nullable();
            $table->string('published_day')->nullable(['Sunday', 'Monday', 'Tusday', 'Wednesday','Thursday', 'Friday', 'Saturday']);
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
