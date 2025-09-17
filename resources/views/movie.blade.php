<x-layout>
    <div class="container mx-auto">
        <div id="movie-info" class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-[10%] mb-[10%]">

            <img class="max-w-md" src="https://image.tmdb.org/t/p/original{{ $movieData["poster_path"] }}" alt="{{ $movieData["title"] }}">
            <div>
                <h1>{{ $movieData["title"] }}</h1>
                <h2 class="mt-5">{{ substr($movieData["release_date"], 0, 4) }}</h2>
                <p class="mt-7 text-xl">{{ $movieData["overview"] }}</p>
            </div>
            <div class="grid grid-cols-1 content-start">
                <div class="flex flex-row gap-10 justify-center">
                    <ion-icon class="text-5xl" name="eye-outline"></ion-icon>
                    <ion-icon class="text-5xl" name="heart-outline"></ion-icon>
                    <ion-icon class="text-5xl" name="add-circle-outline"></ion-icon>
                </div>
                <div class="bg-bright-red h-15 mt-7 content-center text-center">
                    <p class="text-3xl">Rate or Review</p>
                </div>
                <div class="flex flex-row gap-3 mt-3 content-center">
                    <h3>
                        TMDB Rating: {{number_format($movieData["vote_average"], 1) }}/10
                    </h3>
                    <ion-icon class="fill-yellow-400 text-3xl" name="star"></ion-icon>
                </div>
                <div class="flex flex-row gap-3 mt-3 content-center">
                    <h3>
                        User Rating: 9/10
                    </h3>
                    <ion-icon class="fill-yellow-400 text-3xl" name="star"></ion-icon>
                </div>
            </div>
        </div>
    </div>
</x-layout>
