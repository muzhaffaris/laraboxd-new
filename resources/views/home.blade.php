<x-layout>

    <div class=" px-7 bg-amber-200">

        <div id="popular-movies-section" class="pt-7 mb-14" >
            <h3>
                Popular Movies
            </h3>
            <hr class="mb-3 mt-1">
            <div class="flex flex-row overflow-x-auto justify-between gap-4">
        
                @foreach($topMovieData as $mov)
                    <a href="/movie/{{$mov['tmdb_id']}}">
                        <img src="{{ $mov['poster_url'] }}" class="max-w-[250]" alt="">                
                    </a>
                @endforeach
            </div>
        </div>

        <div id="new-reviews-section" >    
            <h3>
                New Reviews
            </h3>
            <hr class="mb-3 mt-1">
        </div>
    </div>

</x-layout>
