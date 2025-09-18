<x-layout>
    <div class="container mx-auto">
        <div id="movie-info" class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-[10%]">
            <div>
                <img class="object-contain" src="https://image.tmdb.org/t/p/original{{ $movieData["poster_path"] }}" alt="{{ $movieData["title"] }}">
            </div>
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
                <a href="{{$movieData["id"]}}/addReview">
                    <div class="bg-bright-red hover:bg-red-400 h-15 mt-7 content-center text-center">
                        <p class="text-3xl">Rate or Review</p>
                    </div>
                </a>
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


        <h3 class="mt-7">Reviews</h3>
        <hr class="my-3">

        <div id="reviews-section" class="flex flex-col">

            @if($reviews)
            @foreach($reviews as $review)
            {{-- card-start --}}
            <div class="flex flex-col bg-greyish-blueish mb-3 px-3">
                <div class="flex gap-3 flex-row items-center my-3">
                    <div class="w-12 h-12">
                        <img src="{{ asset('images/defaultpp.png') }}" sclass="rounded-full w-full h-full object-cover" alt="User Profile Picture">
                    </div>
                    <p>{{$review["username"]}}</p>
                </div>
                <p>{{ $review["rating"] }}/10⭐</p>
                <p class="mb-3">{{ $review["review"] }}</p>
            </div>
            {{-- card-end --}}
            @endforeach
            @else
            <h2>No Reviews Yet</h2>
            @endif

        </div>




    </div>
</x-layout>
