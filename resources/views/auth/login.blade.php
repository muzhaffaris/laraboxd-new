<x-layout>
    <div>
        <div class="flex flex-col w-1/4 mx-auto mt-3 justify-center gap-3">
            <h1>Log Into Your Account</h1>
            <form action="" method="post">
                @csrf

                <div class="flex flex-col mb-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="ramona.fllwers@7ex.com" required value="{{ old('email') }}" class="bg-gray-700 h-9">

                </div>
                <div class="flex flex-col">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="!lll3av3u4lonef0rv3rnow" class="bg-gray-700 h-9" required>

                </div>
                <button type="submit" class="btn mt-4 cursor-pointer bg-bright-red px-5 py-2 hover:bg-white hover:text-bright-red transition">Log in</button>
            </form>

            <p>Don't have an account? <a href="{{ route('show.register') }}" class="text-blue-500">Register</a></p>
        </div>
    </div>
</x-layout>
