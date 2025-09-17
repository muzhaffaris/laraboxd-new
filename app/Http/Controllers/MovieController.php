<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\MovieLog;
use App\Models\User;
use Exception;

class MovieController extends Controller
{

    private function getMovieFromTMDBAPI($movieId)
    {
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_API_BASE_URL');

        $response = Http::acceptJson()->withToken(
            $apiKey
        )->get(
            sprintf("%s/movie/%s?language=en-US", $baseUrl, $movieId)
        );

        if ($response->successful()) {
            $movieData = $response->json();
        } else {
            throw new Exception('Could not fetch data from the TMDB API!');
            return view('error_view')->with('error', 'Could not fetch data from the TMDB API.');
        }

        return $movieData;
    }

    public function home()
    {
        // get movies from TMDB
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

        // get reviews
        $movLogs = MovieLog::orderBy('created_at', 'desc')->whereNotNull('review')->take(6)->get();
        $reviewsDispArr = array();

        foreach ($movLogs as $movLog) {
            print_r($movLog->review);
            $username = User::find($movLog->user_id)->name;
            $review = $movLog->review;
            $movie = $this->getMovieFromTMDBAPI($movLog->tmdb_movie_id);
            $movieTitle = $movie["title"];
            $movieYear = substr($movie["release_date"], 0, 4);
            $moviePoster = $movie["poster_path"];
            $rating = $movLog->rating;
            array_push($reviewsDispArr, ["username" => $username, "review" => $review, "movieTitle" => $movieTitle, "movieYear" => $movieYear, "rating" => $rating, "moviePoster" => $moviePoster]);
        }

        return view('home', ['topMovieData' => $topPopMovies, 'reviews' => $reviewsDispArr]);
    }

    public function movies()
    {
        return view('movies');
    }

    public function movie($movieId)
    {
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_API_BASE_URL');

        $response = Http::acceptJson()->withToken(
            $apiKey
        )->get(
            sprintf("%s/movie/%s?language=en-US", $baseUrl, $movieId)
        );

        if ($response->successful()) {
            $movieData = $response->json();
            // print_r($movieData);
        } else {
            return view('error_view')->with('error', 'Could not fetch data from the TMDB API.');
        }

        return view('movie', ['movieData' => $movieData]);
    }

    public function moviesApiProxy(Request $request)
    {

        try {
            $apiKey = env('TMDB_API_KEY');
            $baseUrl = env('TMDB_API_BASE_URL');

            $page = $request->query('page', '1');
            $search = $request->query('search_query', false);

            $response = Http::acceptJson()->withToken(
                $apiKey
            )->get(
                sprintf("%s/discover/movie?sort_by=popularity.desc&page=%s", $baseUrl, $page)
            );

            if ($response->successful()) {
                return response()->json($response->json());
            }

            // Handle non-successful responses
            return response()->json(['error' => 'Failed to fetch data from external API'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }

    public function moviesSearchApiProxy(Request $request)
    {

        try {
            $apiKey = env('TMDB_API_KEY');
            $baseUrl = env('TMDB_API_BASE_URL');

            $page = $request->query('page', '1');
            $search = $request->query('search_query', false);

            if ($search) {
                $response = Http::acceptJson()->withToken(
                    $apiKey
                )->get(
                    sprintf("%s/search/movie?query=%s&include_adult=false&page=%s", $baseUrl, $search, $page)
                );

                if ($response->successful()) {
                    return response()->json($response->json());
                }
            }

            // Handle non-successful responses
            return response()->json(['error' => 'Failed to fetch data from external API'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
}
