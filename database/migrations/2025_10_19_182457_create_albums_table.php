<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->date('release_date');
            $table->string('genre');
            // Foreign Key from Artist table for assignment to an artist
            $table->foreignId('artist_id')->constrained('artists')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};

