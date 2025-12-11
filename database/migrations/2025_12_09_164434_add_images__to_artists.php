<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add image_url column to artists table to store artist image URLs obtained from Spotify API.
        Schema::table('artists', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('artist_name');
        });
    }

    public function down(): void
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
};