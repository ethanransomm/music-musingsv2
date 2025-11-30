<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            // Foreign Key from Album table to create songs assigned to an album
            $table->foreignId('album_id')->constrained('albums')->cascadeOnDelete();
            $table->integer('duration')->nullable();
            $table->integer('track_number')->default(0);
            
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};


