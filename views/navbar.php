<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-white text-2xl font-bold">
                <a href="index.php">Hydro</a>
            </div>

            <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-white hover:text-blue-300">Login</a>
                    <a href="#" class="text-white hover:text-blue-300">Register</a>
            </div>
        </div>
    </nav>

    <script>
        const hamburger = document.getElementById("hamburger");
        const menu = document.getElementById("menu");

        hamburger.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>
</body>
</html>
