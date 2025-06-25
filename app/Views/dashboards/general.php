    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>General Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-10 rounded-xl shadow-2xl text-center max-w-lg w-full transform transition-all duration-300 hover:scale-105">
            <h1 class="text-5xl font-extrabold text-gray-800 mb-4 animate-fade-in-down">Welcome, User <span class="text-gray-600"><?= esc($userName) ?></span>!</h1>
            <p class="text-gray-700 text-lg mb-8 leading-relaxed">
                You are on the general dashboard. Your role is not specifically recognized for a dedicated dashboard.
            </p>
            <div class="space-y-4">
                <a href="<?= base_url('logout') ?>" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                    Logout
                </a>
            </div>
        </div>
    </body>
    </html>
    