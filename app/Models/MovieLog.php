<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieLog extends Model
{
    protected $fillable = ["user_id", "liked", "rating", "review", "tmdb_movie_id"];

    /** @use HasFactory<\Database\Factories\MovieLogFactory> */
    use HasFactory;
}
