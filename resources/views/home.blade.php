<x-layout>
    <div class="container mx-auto">
        <div id="popular-movies-section" class="pt-7 mb-14">
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

        <div id="new-reviews-section" class="mb-3">
            <h3>
                New Reviews
            </h3>
            <hr class="mb-3 mt-1">
            <div class="grid md:grid-cols-2 gap-4 justify-items-center md:justify-items-stretch">
                @foreach($reviews as $review)
                {{-- card start --}}
                <div class="min-h-[25vh] bg-greyish-blueish flex flex-col gap-4 p-3 w-full max-w-sm md:max-w-none md:m-0">
                    <div class="flex flex-row">
                        <a href="/movie/{{$review["movId"]}}">
                            <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2{{ $review["moviePoster"] }}" class="object-contain w-40" alt="Movie Poster">
                        </a>
                        <div class="flex flex-col justify-between h-full p-3 row-span-2 md:col-span-2">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12">
                                    <img src="{{ asset('images/defaultpp.png') }}" class="rounded-full w-full h-full object-contain" alt="User Profile Picture">
                                </div>
                                <p class="text-white font-semibold">{{ $review["username"] }}</p>
                            </div>

                            <div class="text-white flex flex-col gap-2 mt-auto">
                                <h4>{{ $review["movieTitle"] }}</h4>
                                <p>{{ $review["movieYear"] }}</p>
                                <p>{{ $review["rating"] }}/10⭐</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-3">
                        {{ $review["review"] }}
                    </div>
                </div>
                {{-- card end --}}
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
