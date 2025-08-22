<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laraboxd</title>

    @vite('resources/css/app.css')

</head>
<body>
    <header class="bg-greyish-blueish">
        <nav class="flex justify-between items-center w-[90%] mx-auto">
            <div>
                <img class="w-16 p-4" src="{{ asset('images/logo.svg') }}" alt="logo">
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
                        <button class="bg-[#1E1E1E] px-5 py-2 hover:bg-white hover:text-black transition cursor-pointer">Sign In</button>
                    </li>
                </ul>
            </div>
            <div class="md:hidden">
                <ion-icon onclick="onToggleMenu(this)" name="menu-outline" class="text-3xl cursor-pointer"></ion-icon>
            </div>
        </nav>
    </header>

    <main class="container">
        {{$slot}}
    </main>

    <script>
        const navLinks = document.querySelector(".nav-links")
        function onToggleMenu(e){
            if (e.name == "menu"){
                e.name = "close";
                navLinks.classList.add("top-[7vh]");
            } else {
                e.name = "menu";
                navLinks.classList.remove("top-[7vh]");
            }

        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
