<x-layout>
    <div class="container mx-auto mt-5">
        <h1>Movie List</h1>
        <div>
            <input type="text" placeholder="Search Movie" name="movie_search" id="movie-search-bar" class="bg-gray-700 h-9">
        </div>
        <div id="movies-container" class="md:grid-cols-5 sm:grid-cols-2 grid-cols-1 grid md:justify-between gap-5 mt-3">
        </div>
    </div>


    <script>
        function getMovieImg(posterPath, movieTitle) {
            return ` <a href="{{ route('movie') }}">
                        <div class="min-w-44 min-h-96">
                            <img src="https://image.tmdb.org/t/p/original${posterPath}" class="" alt="${movieTitle}">
                        </div>
                    </a>

            `;
        }

        const moviesContainer = $("#movies-container");
        const spinner = `<div role="status">
                <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>`

        moviesContainer.append(spinner);

        var firstLoaded = false;
        if ($("#movie-search-bar").val().trim() === '' && !firstLoaded) {

            firstLoaded = true;
            $.ajax({
                url: `/api/movies`
                , type: 'GET'
                , dataType: 'json'
                , success: function(data) {
                    console.log("Success:", data);
                    var moviesArr = data.results;

                    moviesContainer.empty();

                    if (moviesArr.length >= 1) {
                        for (let i = 0; i < moviesArr.length; i++) {
                            var movie = moviesArr[i];
                            const movieImg = getMovieImg(movie.poster_path, movie.title);
                            moviesContainer.append(movieImg);
                        }
                    } else {
                        moviesContainer.append("<h3> No movie found! </h3>");
                    }
                }
                , error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error:", textStatus, errorThrown);
                }
            });
        }

        var debounceTimeout;
        $("#movie-search-bar").on("keyup", function() {
            // On each keypress, clear the existing timeout
            clearTimeout(debounceTimeout);

            var searchQuery = $(this).val();
            moviesContainer.empty();
            moviesContainer.append(spinner);

            // Set a new timeout
            debounceTimeout = setTimeout(function() {
                // Only run this code if the user has stopped typing for 500ms

                // Optional: Prevent sending a request if the input is empty
                if (searchQuery.trim() === '') {
                    $.ajax({
                        url: `/api/movies`
                        , type: 'GET'
                        , dataType: 'json'
                        , success: function(data) {
                            // Handle a successful response here
                            console.log("Success:", data);
                            var moviesArr = data.results;

                            moviesContainer.empty();

                            if (moviesArr.length >= 1) {
                                for (let i = 0; i < moviesArr.length; i++) {
                                    var movie = moviesArr[i];
                                    const movieImg = getMovieImg(movie.poster_path, movie.title);
                                    moviesContainer.append(movieImg);
                                }
                            } else {
                                moviesContainer.append("<h3> No movie found! </h3>");
                            }

                        }
                        , error: function(jqXHR, textStatus, errorThrown) {
                            // Handle an error here
                            console.log("Error:", textStatus, errorThrown);
                        }
                    });
                }

                console.log("Searching for:", searchQuery);

                $.ajax({
                    url: `/api/movies/search?search_query=${encodeURIComponent(searchQuery)}`
                    , type: 'GET'
                    , dataType: 'json'
                    , success: function(data) {
                        // Handle a successful response here
                        console.log("Success:", data);
                        var moviesContainer = $("#movies-container");
                        var moviesArr = data.results;

                        moviesContainer.empty();

                        if (moviesArr.length >= 1) {
                            for (let i = 0; i < moviesArr.length; i++) {
                                var movie = moviesArr[i];
                                const movieImg = getMovieImg(movie.poster_path, movie.title);
                                moviesContainer.append(movieImg);
                            }
                        } else {
                            moviesContainer.append("<h3> No movie found! </h3>");
                        }

                    }
                    , error: function(jqXHR, textStatus, errorThrown) {
                        // Handle an error here
                        console.log("Error:", textStatus, errorThrown);
                    }
                });
            }, 500);
        });

    </script>
</x-layout>
