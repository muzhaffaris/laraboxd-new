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
                <div class="min-h-[25vh] bg-slate-200 grid grid-cols-3 grid-rows-3 gap-4 p-3 w-full max-w-sm md:max-w-none md:m-0">
                    <div class="row-span-2 md:col-span-1 bg-white">
                        <img src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/aQPvW8ksMBpmRVIRJXskryoSq6f.jpg" class="w-full h-full object-cover" alt="Movie Poster">
                    </div>

                    <div class="flex flex-col justify-between h-full bg-amber-700 p-3 row-span-2 md:col-span-2">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12">
                                <img src="{{ asset('images/defaultpp.png') }}" class="rounded-full w-full h-full object-cover" alt="User Profile Picture">
                            </div>
                            <p class="text-white font-semibold">Username</p>
                        </div>

                        <div class="text-white flex flex-col gap-2 mt-auto">
                            <h4>Upload</h4>
                            <p>2025</p>
                            <p>9/10⭐</p>
                        </div>
                    </div>

                    <div class="col-span-3 row-start-3 bg-amber-300 p-3">
                        aslkdja lkasjd l kajd laksd lkajsd
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
