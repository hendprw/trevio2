<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trevio - Booking Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-white text-gray-800 flex flex-col min-h-screen">

<nav class="bg-white/95 backdrop-blur-sm py-4 px-4 md:px-6 sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="/" class="flex items-center gap-1 group">
            <div class="bg-blue-50 p-1.5 rounded-lg group-hover:bg-blue-100 transition">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <span class="text-2xl font-bold text-gray-900 tracking-tight">trevi<span class="text-blue-600">o</span></span>
        </a>

        <div class="flex items-center gap-4 md:gap-6">
            <div class="hidden md:flex items-center gap-2 text-sm font-medium text-gray-600 cursor-pointer hover:text-blue-600 transition">
                <span class="bg-gray-100 px-2 py-1 rounded text-xs">IDR</span>
            </div>

            <?php if(isset($_SESSION['user'])): ?>
                <div class="flex items-center gap-3">
                    <a href="/profile" class="text-right hidden md:block group cursor-pointer">
                        <p class="text-xs text-gray-500 group-hover:text-blue-600 transition">Hello,</p>
                        <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition"><?= htmlspecialchars($_SESSION['user']['name']) ?></p>
                    </a>
                    
                    <a href="/profile" class="relative group">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user']['name']) ?>&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full border-2 border-white shadow-sm group-hover:shadow-md transition ring-2 ring-transparent group-hover:ring-blue-100">
                    </a>
                </div>
            <?php else: ?>
                <div class="flex gap-3">
                    <a href="/login" class="hidden md:block px-4 py-2 text-sm font-bold text-gray-600 hover:text-blue-600 transition">Masuk</a>
                    <a href="/register" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-sm font-bold shadow-lg shadow-blue-500/30 transition transform active:scale-95">Daftar</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="flex-grow relative w-full">