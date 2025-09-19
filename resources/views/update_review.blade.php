<x-layout>
    <div class="container mx-auto">
        <div class="flex flex-col justify-center text-center">
            <h1>Add Review</h1>
            <h2>{{$movieTitle}}</h2>
            <form action="{{ route('updateReview', $reviewId) }}" method="post">
                @csrf
                <div class="flex flex-col text-start">
                    <label for="rating">rate</label>
                    <input min="1" max="10" type="number" name="rating" placeholder="1-10" class="bg-gray-700 p-2 mb-3" value="{{ $reviewData["rating"] }}" required>

                    <label for="review">review</label>
                    <textarea name="review" maxlength="900" class="bg-gray-700 h-56 p-2" placeholder="write your updated review here"></textarea>

                    <label for="liked">Like?</label>
                    <input type="checkbox" name="liked" value="1" @if($reviewData["liked"]==1) checked @endif>

                    <button type="submit" class="btn mt-4 cursor-pointer bg-bright-red px-5 py-2 hover:bg-white hover:text-bright-red transition">Update Review</button>

                </div>
            </form>
        </div>
    </div>
</x-layout>
