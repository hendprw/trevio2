<?php include __DIR__.'/../layout_head.php'; ?>

<div class="relative h-[60vh] min-h-[400px] w-full overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop');"></div>
    
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/70 via-black/40 to-transparent"></div>

    <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white/5 rounded-full blur-xl animate-pulse-slow"></div>
    <div class="absolute bottom-1/3 right-1/4 w-40 h-40 bg-blue-400/10 rounded-full blur-xl animate-pulse-slow delay-500"></div>
    <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-white/5 rounded-full blur-xl animate-pulse-slow animation-delay-1000"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4 pb-12">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-5 tracking-tight drop-shadow-lg leading-tight">
            Temukan Petualangan <br> Penginapan Impianmu
        </h1>
        <p class="text-lg md:text-xl font-medium opacity-90 drop-shadow-md max-w-2xl">
            Cari dan pesan hotel terbaik dengan harga jujur, fasilitas lengkap, dan tanpa biaya tersembunyi.
        </p>
        <style>
            @keyframes pulse-slow {
                0%, 100% { transform: scale(1); opacity: 0.1; }
                50% { transform: scale(1.2); opacity: 0.2; }
            }
            .animate-pulse-slow {
                animation: pulse-slow 8s infinite ease-in-out;
            }
            .animation-delay-500 { animation-delay: 0.5s; }
            .animation-delay-1000 { animation-delay: 1s; }
        </style>
    </div>
</div>

<div class="relative z-20 -mt-20 md:-mt-24 max-w-6xl mx-auto px-4 mb-16 md:mb-24">
    <div class="bg-white rounded-2xl shadow-xl p-5 md:p-8 border border-gray-100">
        
        <div class="flex items-center gap-2 mb-6 text-blue-600 border-b border-gray-100 pb-4">
            <div class="bg-blue-50 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <span class="font-bold text-lg">Cari Hotel</span>
        </div>

        <form action="/" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            
            <div class="md:col-span-4 relative group">
                <label class="block text-[10px] font-bold text-gray-400 tracking-wider mb-1 uppercase">Destinasi</label>
                <div class="border border-gray-200 rounded-xl p-3 hover:border-blue-500 transition bg-gray-50 group-hover:bg-white flex items-center gap-2 h-[50px]">
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <input type="text" name="q" placeholder="Mau nginep dimana?" class="w-full text-sm font-bold text-gray-800 placeholder-gray-400 outline-none bg-transparent">
                </div>
            </div>

            <div class="md:col-span-2 relative group">
                <label class="block text-[10px] font-bold text-gray-400 tracking-wider mb-1 uppercase">Check In</label>
                <div class="border border-gray-200 rounded-xl p-3 hover:border-blue-500 transition bg-gray-50 group-hover:bg-white h-[50px]">
                    <input type="text" placeholder="Tanggal" onfocus="(this.type='date')" class="w-full text-sm font-bold text-gray-800 placeholder-gray-400 outline-none bg-transparent cursor-pointer">
                </div>
            </div>

            <div class="md:col-span-2 relative group">
                <label class="block text-[10px] font-bold text-gray-400 tracking-wider mb-1 uppercase">Check Out</label>
                <div class="border border-gray-200 rounded-xl p-3 hover:border-blue-500 transition bg-gray-50 group-hover:bg-white h-[50px]">
                    <input type="text" placeholder="Tanggal" onfocus="(this.type='date')" class="w-full text-sm font-bold text-gray-800 placeholder-gray-400 outline-none bg-transparent cursor-pointer">
                </div>
            </div>

            <div class="md:col-span-2 relative group">
                <label class="block text-[10px] font-bold text-gray-400 tracking-wider mb-1 uppercase">Tamu</label>
                <div class="border border-gray-200 rounded-xl p-3 hover:border-blue-500 transition bg-gray-50 group-hover:bg-white h-[50px] flex items-center">
                    <div class="text-sm font-bold text-gray-800 truncate flex items-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="truncate">1 Kamar, 2 Tamu</span>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="hidden md:block text-[10px] font-bold text-transparent mb-1 select-none">Action</label>
                <button type="submit" class="w-full h-[50px] bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2 transition transform active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span class="font-bold">Cari</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-5xl mx-auto px-6 mb-20 md:mb-28 text-center">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-12 md:mb-16">Kenapa Booking di Trevio?</h2>
    
    <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
        <svg class="hidden md:block absolute top-8 left-[16%] w-[68%] h-20 z-0 pointer-events-none text-gray-200" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="6 6">
            <path d="M0,10 C50,50 150,50 200,10 S350,-30 400,10 S550,50 600,10" vector-effect="non-scaling-stroke" />
        </svg>

        <div class="relative z-10 flex flex-col items-center p-4 md:p-0 bg-white md:bg-transparent rounded-xl md:rounded-none shadow-sm md:shadow-none border md:border-none border-gray-50">
            <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-4 text-blue-600 shadow-sm">
                <span class="text-xl font-bold">$</span>
            </div>
            <h3 class="text-gray-800 font-bold text-lg">Harga Jujur</h3>
            <p class="text-gray-500 text-sm mt-2 px-2">Tidak ada biaya tersembunyi saat checkout.</p>
        </div>

        <div class="relative z-10 flex flex-col items-center p-4 md:p-0 bg-white md:bg-transparent rounded-xl md:rounded-none shadow-sm md:shadow-none border md:border-none border-gray-50">
            <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-4 text-blue-600 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-gray-800 font-bold text-lg">Konfirmasi Instan</h3>
            <p class="text-gray-500 text-sm mt-2 px-2">E-voucher terbit otomatis setelah pembayaran.</p>
        </div>

        <div class="relative z-10 flex flex-col items-center p-4 md:p-0 bg-white md:bg-transparent rounded-xl md:rounded-none shadow-sm md:shadow-none border md:border-none border-gray-50">
            <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-4 text-blue-600 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-gray-800 font-bold text-lg">Fleksibilitas</h3>
            <p class="text-gray-500 text-sm mt-2 px-2">Reschedule mudah dan opsi refund tersedia.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-6 mb-24">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Destinasi Populer</h2>
            <p class="text-gray-500 mt-1">Pilihan favorit wisatawan minggu ini</p>
        </div>
        
        <div class="w-full md:w-auto overflow-x-auto pb-2 no-scrollbar flex gap-3">
            <button class="bg-gray-900 text-white px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap shadow-lg shadow-gray-900/20">🔥 Semua</button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-gray-800 hover:text-gray-900 transition">Bali</button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-gray-800 hover:text-gray-900 transition">Jogja</button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-gray-800 hover:text-gray-900 transition">Bandung</button>
        </div>
    </div>

    <?php if(empty($hotels)): ?>
        <div class="p-12 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <h3 class="text-lg font-bold text-gray-600">Belum ada data hotel</h3>
            <p class="text-gray-400">Silakan login sebagai Owner untuk menambah hotel.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($hotels as $h): ?>
            <a href="/hotel?id=<?= $h['id'] ?>" class="group relative block h-[380px] md:h-[420px] rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <img src="/<?= $h['thumbnail'] ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition"></div>
                <div class="absolute bottom-0 left-0 p-6 w-full text-white">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl md:text-2xl font-bold leading-tight pr-2"><?= $h['name'] ?></h3>
                        <div class="bg-white/20 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold">4.8 ★</div>
                    </div>
                    <p class="text-sm text-gray-300 mb-4 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <?= $h['city'] ?>
                    </p>
                    <div class="border-t border-white/20 pt-3 flex justify-between items-end">
                        <div>
                            <p class="text-xs text-gray-400">Mulai dari</p>
                            <p class="text-yellow-400 font-bold text-lg">Rp <?= number_format($h['start_price'] ?? 0) ?></p>
                        </div>
                        <span class="text-xs bg-blue-600 px-3 py-1.5 rounded-lg font-bold">Lihat</span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="fixed bottom-4 left-4 right-4 md:left-1/2 md:right-auto md:-translate-x-1/2 md:w-fit z-40">
    <div class="bg-gray-900/90 backdrop-blur-md text-white py-3 px-4 md:px-6 rounded-2xl shadow-2xl border border-white/10 flex items-center gap-4 justify-between">
        <div class="text-sm font-medium hidden md:block">
            Dapatkan diskon pengguna baru hingga 50%
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <a href="/register" class="flex-1 md:flex-none text-center bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-xl text-sm font-bold transition">Daftar Sekarang</a>
            <button onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="p-2 hover:bg-white/10 rounded-lg transition">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
</div>

<div class="pb-12"></div>

<?php include __DIR__.'/../layout_foot.php'; ?>