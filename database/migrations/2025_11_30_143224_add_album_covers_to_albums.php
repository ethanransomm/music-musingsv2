<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add cover_url column to albums table to store album cover image URLs.
        Schema::table('albums', function (Blueprint $table) {
            $table->string('cover_url')->nullable()->after('genre');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('cover_url');
        });
    }
};
