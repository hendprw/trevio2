<?php include __DIR__.'/../layout_head.php'; ?>

<?php
// Helper untuk menentukan menu sidebar aktif
$role = $_SESSION['user']['role'];
?>

<div class="min-h-screen bg-gray-50 flex pt-4 pb-10 px-4 md:px-8 gap-8">
    
    <div class="w-full md:w-72 flex-shrink-0 hidden md:block">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            
            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-100">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=0D8ABC&color=fff" class="w-12 h-12 rounded-full">
                <div>
                    <h4 class="font-bold text-gray-900 text-sm"><?= htmlspecialchars($user['name']) ?></h4>
                    <p class="text-xs text-gray-500 capitalize"><?= $user['role'] ?> Account</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="/profile" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-bold text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Personal Data
                </a>

                <?php if($role == 'user'): ?>
                <a href="/my-bookings" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    My Trips / Bookings
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    Wishlist
                </a>
                <?php endif; ?>

                <?php if($role == 'owner'): ?>
                <a href="/owner/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    My Properties
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Financial Account
                </a>
                <?php endif; ?>

                <?php if($role == 'admin'): ?>
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Transactions & Payouts
                </a>
                <?php endif; ?>
                
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <a href="/logout" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold text-sm transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Log out
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <div class="flex-1 w-full">
        
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8 mb-6 flex flex-col md:flex-row items-center gap-6">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=0D8ABC&color=fff" class="w-24 h-24 rounded-full border-4 border-blue-50">
            </div>
            <div class="text-center md:text-left flex-1">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">My Profile</h2>
                <p class="text-gray-500 text-sm">Manage your personal information and account security.</p>
            </div>
            <button class="flex items-center gap-2 border border-gray-200 px-4 py-2 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-50 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-10">
            <form action="/profile/update" method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-bold text-gray-900 mb-2">Full Name</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="w-full border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-bold text-gray-900 mb-2">Account Type</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <input type="text" value="<?= strtoupper($user['role']) ?>" disabled class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-500 cursor-not-allowed">
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-900 mb-2">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="w-full border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-bold text-gray-900 mb-2">Phone Number</label>
                        <div class="relative flex">
                            <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-200 bg-gray-50 text-gray-500 sm:text-sm">
                                <img src="https://flagcdn.com/w20/id.png" class="w-5 mr-2"> +62
                            </span>
                            <input type="text" placeholder="812 3456 7890" class="flex-1 border border-gray-200 rounded-r-xl py-3 px-4 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-bold text-gray-900 mb-2">Zip Code</label>
                        <input type="text" placeholder="12345" class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                     <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-900 mb-2">Address</label>
                        <input type="text" placeholder="Jalan Sudirman No. 1, Jakarta" class="w-full border border-gray-200 rounded-xl py-3 px-4 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                </div>

                <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-gray-100">
                    <button type="button" class="px-6 py-2.5 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition">
                        Discard
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 text-sm font-bold text-white hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition transform active:scale-95">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>