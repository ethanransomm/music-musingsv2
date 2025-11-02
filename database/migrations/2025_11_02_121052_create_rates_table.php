<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            // Foreign Key for the user rating an album 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Foreign Key for the album being rated
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->integer('score');
            $table->text('comment')->nullable();
            $table->timestamps();
            // Ensures one user can only rate an album once, for one to one relationship
            $table->unique(['user_id', 'album_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};


