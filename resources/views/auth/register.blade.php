<x-layout>
    <div>
        <div class="flex flex-col w-1/4 mx-auto mt-3 justify-center gap-3">
            <h1>Create New Account</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf

                <div class="flex flex-col mb-2">
                    <label for="email">Name:</label>
                    <input type="text" name="name" placeholder="Ramona Flowers" required value="{{ old('name') }}" class="bg-gray-700 h-9">
                </div>
                <div class="flex flex-col mb-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="ramona.fllwers@7ex.com" required value="{{ old('email') }}" class="bg-gray-700 h-9">
                </div>
                <div class="flex flex-col mb-2">
                    <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="5tronkP4sswerd" class="bg-gray-700 h-9" required>
                </div>
                <div class="flex flex-col">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" placeholder="5tronkP4sswerd" class="bg-gray-700 h-9" required>
                </div>
                <button type="submit" class="btn mt-4 cursor-pointer bg-bright-red px-5 py-2 hover:bg-white hover:text-bright-red transition">Register</button>
            </form>

            {{-- validation error --}}
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)                    
                        <li class="bg-red-400 text-white p-3"> {{ $error }} </li>
                    @endforeach
                </ul>    
            @endif
            
        </div>
    </div>
</x-layout>
