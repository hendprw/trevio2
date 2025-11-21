<?php include __DIR__.'/../layout_head.php'; ?>

<div class="bg-white border-b border-gray-100 sticky top-[72px] z-30">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="/" class="hover:text-blue-600 transition">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-gray-900 font-semibold truncate max-w-[150px]"><?= htmlspecialchars($hotel['name']) ?></span>
        </div>
        <div class="flex gap-2">
            <button class="text-gray-400 hover:text-red-500 transition p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
            <button class="text-gray-400 hover:text-blue-600 transition p-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
            </button>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 md:px-6 py-6">

    <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-2 h-[300px] md:h-[450px] rounded-3xl overflow-hidden mb-8 relative">
        <div class="md:col-span-2 md:row-span-2 relative group cursor-pointer">
            <img src="/<?= htmlspecialchars($hotel['thumbnail']) ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
        </div>
        
        <?php 
        // Ambil 4 foto pertama dari galeri, jika kurang pakai placeholder
        $gallery = $hotel['gallery'] ?? [];
        for($i=0; $i<4; $i++): 
            $img = isset($gallery[$i]) ? '/'.$gallery[$i]['image_path'] : '/uploads/default_room.jpg'; // Fallback image logic could be improved
            // Hide images on mobile except via carousel (not implemented here), keeping it hidden on very small screens if needed or stack
            if(!isset($gallery[$i])) continue; // Skip if no image
        ?>
        <div class="hidden md:block relative group cursor-pointer overflow-hidden">
            <img src="<?= $img ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
        </div>
        <?php endfor; ?>

        <button class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-md text-gray-800 px-4 py-2 rounded-lg text-sm font-bold shadow-lg flex items-center gap-2 hover:bg-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Lihat Semua Foto
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div>
                <div class="flex gap-2 mb-2">
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wide">Hotel</span>
                    <div class="flex text-yellow-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 leading-tight"><?= htmlspecialchars($hotel['name']) ?></h1>
                <div class="flex items-center gap-2 text-gray-600 text-sm mb-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span><?= htmlspecialchars($hotel['address']) ?>, <?= htmlspecialchars($hotel['city']) ?></span>
                    <a href="#" class="text-blue-600 font-bold hover:underline ml-2">Show on Map</a>
                </div>
            </div>

            <div class="border-t border-b border-gray-100 py-6">
                <h3 class="font-bold text-lg mb-4">Fasilitas Populer</h3>
                <?php if(!empty($hotel['facilities'])): ?>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php foreach($hotel['facilities'] as $f): ?>
                        <div class="flex items-center gap-3 text-gray-600">
                            <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm"><?= htmlspecialchars($f['facility_name']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-400 text-sm">Informasi fasilitas belum tersedia.</p>
                <?php endif; ?>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-3">Tentang Akomodasi</h3>
                <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                    <?= nl2br(htmlspecialchars($hotel['description'])) ?>
                </p>
            </div>

            <div id="rooms" class="pt-4">
                <h3 class="font-bold text-2xl mb-6 text-gray-900">Pilih Kamar Anda</h3>
                
                <div class="space-y-6">
                    <?php if(empty($hotel['rooms'])): ?>
                        <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center">
                            <p class="text-gray-500">Maaf, belum ada kamar tersedia untuk hotel ini.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($hotel['rooms'] as $r): ?>
                        <form action="/booking/checkout" method="POST" class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col md:flex-row">
                            <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                            <input type="hidden" name="room_type_id" value="<?= $r['id'] ?>">
                            <input type="hidden" name="price_per_night" value="<?= $r['price'] ?>">

                            <div class="md:w-64 bg-gray-100 relative">
                                <img src="/<?= htmlspecialchars($hotel['thumbnail']) ?>" class="w-full h-full object-cover absolute inset-0">
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($r['name']) ?></h4>
                                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                <?= $r['capacity'] ?> Tamu
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                No Breakfast
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-400 line-through">Rp <?= number_format($r['price'] * 1.2) ?></p>
                                        <p class="text-xl font-bold text-orange-500">Rp <?= number_format($r['price']) ?></p>
                                        <p class="text-xs text-gray-400">/ kamar / malam</p>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col md:flex-row gap-4 items-end">
                                    <div class="flex-1 w-full grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Check In</label>
                                            <input type="date" name="check_in" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-semibold outline-none focus:border-blue-500 transition bg-gray-50" required>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Check Out</label>
                                            <input type="date" name="check_out" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-semibold outline-none focus:border-blue-500 transition bg-gray-50" required>
                                        </div>
                                    </div>
                                    <button class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-lg shadow-blue-600/30 transition transform active:scale-95">
                                        Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="lg:col-span-1 hidden lg:block">
            <div class="sticky top-24 space-y-6">
                
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-lg">
                    <p class="text-gray-500 text-sm mb-1">Harga mulai dari</p>
                    <div class="flex items-baseline gap-1">
                        <span class="text-3xl font-bold text-gray-900">Rp <?= number_format($hotel['rooms'][0]['price'] ?? 0) ?></span>
                        <span class="text-gray-500">/ malam</span>
                    </div>
                    
                    <div class="mt-6 space-y-3">
                        <a href="#rooms" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-xl font-bold shadow-lg shadow-blue-600/30 transition">
                            Lihat Ketersediaan
                        </a>
                        <button class="block w-full border border-gray-200 text-gray-600 text-center py-3 rounded-xl font-bold hover:bg-gray-50 transition">
                            Simpan ke Wishlist
                        </button>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-gray-600">Jaminan Harga Terbaik</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <span class="text-sm text-gray-600">Transaksi Aman</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-100 rounded-3xl h-48 relative overflow-hidden border border-gray-200">
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=Jakarta&zoom=13&size=600x300&key=YOUR_API_KEY_HERE" class="w-full h-full object-cover opacity-50 grayscale">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="bg-white px-4 py-2 rounded-lg shadow text-sm font-bold text-gray-800 hover:bg-gray-50">Lihat di Peta</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>