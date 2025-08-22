<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    public function home()
    {
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_API_BASE_URL');

        $response = Http::acceptJson()->withToken(
            $apiKey
        )->get(
            sprintf("%s/discover/movie?sort_by=popularity.desc", $baseUrl)
        );

        $topPopMovies = array();
        if ($response->successful()) {
            $movieData = $response->json();
            for ($x = 0; $x < 10; $x++) {
                array_push($topPopMovies, [
                    "poster_url" => sprintf("https://image.tmdb.org/t/p/original%s", $movieData["results"][$x]["poster_path"]),
                    "tmdb_id" => $movieData["results"][$x]["id"]
                ]);
            }
            // print_r($topPopMovies);
        } else {
            return view('error_view')->with('error', 'Could not fetch data from the TMDB API.');
        }

        return view('home', ['topMovieData' => $topPopMovies]);
    }
}
