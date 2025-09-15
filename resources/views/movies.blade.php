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
        var firstLoaded = false;
        if ($("#movie-search-bar").val().trim() === '' && !firstLoaded) {

            firstLoaded = true;
            $.ajax({
                url: `/api/movies`
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
                            const movieImg = ` <div class="min-w-44 min-h-96">
                <img src="https://image.tmdb.org/t/p/original${movie.poster_path}" class="" alt="${movie.title}">
                </div>
                `;
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

        var debounceTimeout;
        $("#movie-search-bar").on("keyup", function() {
            // On each keypress, clear the existing timeout
            clearTimeout(debounceTimeout);

            var searchQuery = $(this).val();

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
                            var moviesContainer = $("#movies-container");
                            var moviesArr = data.results;

                            moviesContainer.empty();

                            if (moviesArr.length >= 1) {
                                for (let i = 0; i < moviesArr.length; i++) {
                                    var movie = moviesArr[i];
                                    const movieImg = ` <div class="min-w-44 min-h-96">
                        <img src="https://image.tmdb.org/t/p/original${movie.poster_path}" class="" alt="${movie.title}">
                        </div>
                        `;
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
                                const movieImg = ` 
                                <div class="min-w-44 min-h-96">
                                    <img src="https://image.tmdb.org/t/p/original${movie.poster_path}" class="" alt="${movie.title}">
                                </div>
                            `;
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

            }, 500); // Wait for 500ms after the last keyup
        });

    </script>
</x-layout>
