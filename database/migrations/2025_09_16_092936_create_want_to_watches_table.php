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
        Schema::create('want_to_watches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->tinyText("tmdb_movie_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('want_to_watches');
    }
};
