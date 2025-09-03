<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laraboxd</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    @vite('resources/css/app.css')

</head>
<body>
    <header class="bg-greyish-blueish">
        <nav class="flex justify-between items-center w-[90%] mx-auto">
            <div>
                <a href="/">
                    <img class="w-16 p-4" src="{{ asset('images/logo.svg') }}" alt="logo">
                </a>
            </div>
            <div class="nav-links md:static absolute bg-greyish-blueish md:min-h-fit min-h-[20vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5 justify-center md:justify-start">
                <ul class="flex md:flex-row flex-col items-center md:gap-6 gap-8 ">
                    <li>
                        <a href="#" class="hover:text-gray-500">Films</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-gray-500">Reviews</a>
                    </li>
                    <li>
                        <a href="{{ route('show.login') }}">
                            <button class="bg-[#1E1E1E] px-5 py-2 hover:bg-white hover:text-black transition cursor-pointer">Log In</button>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            <button class="bg-[#1E1E1E] px-5 py-2 hover:bg-white hover:text-black transition cursor-pointer">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="md:hidden">
                <ion-icon onclick="onToggleMenu(this)" name="menu-outline" class="text-3xl cursor-pointer"></ion-icon>
            </div>
        </nav>
    </header>

    <main>
        {{$slot}}
    </main>

    <footer>
        <div class="bg-greyish-blueish py-3 text-gray-400">
            <div class="flex gap-3 justify-center items-center">
                <p id="movie-quote"></p>
            </div>
            <div class="flex pt-2 gap-3 justify-center items-center">
                <p>2025 Laraboxd</p>
            </div>
        </div>
    </footer>

    <script>
        const navLinks = document.querySelector(".nav-links")

        function onToggleMenu(e) {
            if (e.name == "menu") {
                e.name = "close";
                navLinks.classList.add("top-[7vh]");
            } else {
                e.name = "menu";
                navLinks.classList.remove("top-[7vh]");
            }

        }

    </script>
    <script>
        const apiUrl = 'https://api.allorigins.win/raw?url=https://quoteapi.pythonanywhere.com/random'
        //const apiUrl = 'https://quoteapi.pythonanywhere.com/random';
        const quoteP = document.querySelector("#movie-quote")

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                console.log(data)
                quoteP.textContent = `\"${data.Quotes[0].quote}\"`;
            })
            .catch(error => {
                console.error('Error:', error)
                quoteP.textContent = "Just Keep Swimming";
            });

    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
