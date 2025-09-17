<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WantToWatch extends Model
{
    protected $fillable = ["user_id", "tmdb_movie_id"];

    /** @use HasFactory<\Database\Factories\WantToWatchFactory> */
    use HasFactory;
}
