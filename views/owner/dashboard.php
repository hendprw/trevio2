<?php include __DIR__.'/../layout_head.php'; ?>

<?php
// Ambil data dari session dan controller
$user = $_SESSION['user'];
$earnings = $stats['earnings'] ?? 0;
$pending = $stats['pending'] ?? 0;
$total_hotels = count($hotels);
?>

<div class="min-h-screen bg-gray-50 flex flex-col md:flex-row pt-4 pb-12 px-4 md:px-8 gap-8">
    
    <div class="w-full md:w-72 flex-shrink-0 hidden md:block">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-24">
            
            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-100">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=0D8ABC&color=fff" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                <div class="overflow-hidden">
                    <h4 class="font-bold text-gray-900 text-sm truncate"><?= htmlspecialchars($user['name']) ?></h4>
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Hotel Owner</p>
                </div>
            </div>

            <nav class="space-y-2">
                <a href="/profile" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Personal Data
                </a>

                <a href="/owner/dashboard" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-bold text-sm transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    My Properties
                </a>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium text-sm transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Earnings Report
                </a>

                <div class="pt-4 mt-4 border-t border-gray-100">
                    <a href="/logout" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold text-sm transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Log out
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <div class="flex-1 w-full min-w-0">

        <div class="md:hidden mb-6 -mx-4 px-4 flex gap-2 overflow-x-auto pb-2 no-scrollbar">
            <a href="/owner/dashboard" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap shadow-md">Properties</a>
            <a href="/profile" class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Profile</a>
            <a href="#" class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Earnings</a>
            <a href="/logout" class="bg-red-50 border border-red-100 text-red-600 px-5 py-2 rounded-full text-sm font-bold whitespace-nowrap">Logout</a>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Dashboard Owner</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola properti, kamar, dan pantau pendapatan.</p>
            </div>
            <a href="/owner/create-hotel" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-lg shadow-blue-600/30 transition flex items-center justify-center gap-2 transform active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Hotel
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-10">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center border border-green-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Total Pendapatan</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-900">Rp <?= number_format($earnings) ?></p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center border border-yellow-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Saldo Tertahan</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-900">Rp <?= number_format($pending) ?></p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center border border-blue-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Total Properti</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-900"><?= $total_hotels ?> Hotel</p>
                </div>
            </div>
        </div>

        <div class="space-y-10">
            <?php if(empty($hotels)): ?>
                <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Properti</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Mulai perjalanan bisnis Anda dengan mendaftarkan properti pertama Anda di Trevio.</p>
                    <a href="/owner/create-hotel" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-blue-700 transition inline-block">Daftarkan Hotel</a>
                </div>
            <?php else: ?>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-8 w-1 bg-blue-600 rounded-full"></div>
                    <h3 class="text-xl font-bold text-gray-900">Daftar Properti</h3>
                </div>

                <?php foreach($hotels as $h): ?>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden group hover:border-blue-200 transition duration-300">
                    
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-72 h-52 md:h-auto bg-gray-200 relative overflow-hidden">
                            <img src="/<?= htmlspecialchars($h['thumbnail']) ?>" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent md:hidden"></div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-2 mb-2">
                                    <h3 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($h['name']) ?></h3>
                                    <span class="self-start bg-green-100 text-green-700 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide">Active</span>
                                </div>
                                <div class="flex items-center gap-1 text-gray-500 text-sm mb-4">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                    <?= htmlspecialchars($h['city']) ?>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-2"><?= htmlspecialchars($h['description']) ?></p>
                            </div>
                            
                            <div class="flex gap-2 mt-6">
                                <a href="/owner/edit-hotel?id=<?= $h['id'] ?>" class="px-4 py-2 rounded-lg border border-blue-100 text-blue-600 text-xs font-bold hover:bg-blue-50 transition">
                                    Edit Info
                                </a>
                                <form action="/owner/delete-hotel" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus hotel akan menghapus semua data kamar dan transaksi terkait. Lanjutkan?');">
                                    <input type="hidden" name="hotel_id" value="<?= $h['id'] ?>">
                                    <button class="px-3 py-2 rounded-lg border border-red-100 text-red-500 text-xs font-bold hover:bg-red-50 transition flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50/80 border-t border-gray-100 p-6">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">MANAJEMEN KAMAR</h4>

                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm whitespace-nowrap">
                                    <thead class="bg-gray-50 text-gray-500 border-b border-gray-100">
                                        <tr>
                                            <th class="p-4 font-bold">Tipe Kamar</th>
                                            <th class="p-4 font-bold">Harga / Malam</th>
                                            <th class="p-4 font-bold">Kapasitas</th>
                                            <th class="p-4 font-bold">Stok</th>
                                            <th class="p-4 text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <?php if(empty($h['rooms'])): ?>
                                            <tr>
                                                <td colspan="5" class="p-8 text-center text-gray-400 text-xs italic">
                                                    <span class="block mb-1">Belum ada tipe kamar yang ditambahkan.</span>
                                                    Silakan tambah di formulir bawah.
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach($h['rooms'] as $room): ?>
                                            <tr class="hover:bg-blue-50/30 transition">
                                                <td class="p-4 font-bold text-gray-800"><?= htmlspecialchars($room['name']) ?></td>
                                                <td class="p-4 font-semibold text-blue-600">Rp <?= number_format($room['price']) ?></td>
                                                <td class="p-4 text-gray-600"><?= $room['capacity'] ?> Orang</td>
                                                <td class="p-4">
                                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-bold"><?= $room['qty'] ?> Unit</span>
                                                </td>
                                                <td class="p-4 text-right">
                                                    <form action="/owner/delete-room" method="POST" onsubmit="return confirm('Hapus tipe kamar ini?');" class="inline">
                                                        <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                                                        <button class="text-gray-400 hover:text-red-500 p-1 rounded hover:bg-red-50 transition">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="bg-blue-600 text-white p-1 rounded">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                </div>
                                <span class="font-bold text-blue-900 text-sm">Tambah Tipe Kamar Baru</span>
                            </div>

                            <form action="/owner/add-room" method="POST" class="grid grid-cols-2 md:grid-cols-12 gap-4 items-end">
                                <input type="hidden" name="hotel_id" value="<?= $h['id'] ?>">
                                
                                <div class="col-span-2 md:col-span-4">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase mb-1 block">Nama Tipe</label>
                                    <input type="text" name="name" placeholder="Contoh: Deluxe King View" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none font-semibold" required>
                                </div>
                                
                                <div class="col-span-2 md:col-span-3">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase mb-1 block">Harga (Rp)</label>
                                    <input type="number" name="price" placeholder="0" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none font-semibold" required>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase mb-1 block">Org</label>
                                    <input type="number" name="capacity" placeholder="2" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none font-semibold text-center" required>
                                </div>

                                <div class="col-span-1 md:col-span-2">
                                    <label class="text-[10px] font-bold text-gray-500 uppercase mb-1 block">Stok</label>
                                    <input type="number" name="qty" value="5" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none font-semibold text-center" required>
                                </div>

                                <div class="col-span-2 md:col-span-1">
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg shadow-sm transition flex justify-center items-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>