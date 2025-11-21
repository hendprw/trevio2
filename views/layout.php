<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trevio Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<nav class="bg-blue-600 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-2xl font-bold">Trevio</a>
        <div>
            <?php if(isset($_SESSION['user'])): ?>
                <span class="mr-4">Hi, <?= $_SESSION['user']['name'] ?></span>
                <?php if($_SESSION['user']['role'] == 'owner'): ?>
                    <a href="/owner/dashboard" class="mr-4 hover:underline">Owner Panel</a>
                <?php elseif($_SESSION['user']['role'] == 'admin'): ?>
                    <a href="/admin/dashboard" class="mr-4 hover:underline">Admin Panel</a>
                <?php else: ?>
                    <a href="/my-bookings" class="mr-4 hover:underline">My Bookings</a>
                <?php endif; ?>
                <a href="/logout" class="bg-red-500 px-3 py-1 rounded">Logout</a>
            <?php else: ?>
                <a href="/login" class="mr-4">Login</a>
                <a href="/register" class="bg-white text-blue-600 px-3 py-1 rounded">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mx-auto p-4 min-h-screen">