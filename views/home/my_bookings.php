<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-5xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
                <p class="text-gray-500 mt-1 text-sm">Riwayat perjalanan dan status pembayaran Anda.</p>
            </div>
            <a href="/" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Pesan Hotel Lagi
            </a>
        </div>

        <?php if(empty($bookings)): ?>
            <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 p-12 text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-8 max-w-sm mx-auto">Anda belum melakukan pemesanan hotel apapun. Yuk, mulai rencanakan liburanmu sekarang!</p>
                <a href="/" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-blue-700 transition inline-block">Cari Hotel</a>
            </div>
        <?php else: ?>
            
            <div class="space-y-6">
                <?php foreach($bookings as $b): ?>
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col md:flex-row">
                        
                        <div class="md:w-64 h-48 md:h-auto bg-gray-200 relative group">
                            <img src="/<?= htmlspecialchars($b['thumbnail'] ?? 'uploads/default_hotel.jpg') ?>" class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/10 md:hidden"></div>
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-lg shadow-sm text-gray-800">
                                #TRV-<?= $b['id'] ?>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between">
                            
                            <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1 leading-tight"><?= htmlspecialchars($b['hotel_name']) ?></h3>
                                    <p class="text-sm text-gray-500 font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                        <?= htmlspecialchars($b['room_name']) ?>
                                    </p>
                                    
                                    <div class="flex items-center gap-3 mt-3 text-sm text-gray-600 bg-gray-50 w-fit px-3 py-1.5 rounded-lg border border-gray-100">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span><?= date('d M', strtotime($b['check_in'])) ?></span>
                                        </div>
                                        <span class="text-gray-300">&rarr;</span>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span><?= date('d M Y', strtotime($b['check_out'])) ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="self-start">
                                    <?php if($b['status'] == 'PENDING'): ?>
                                        <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold border border-yellow-100">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span> Menunggu Pembayaran
                                        </span>
                                    <?php elseif($b['status'] == 'PAID'): ?>
                                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-xs font-bold border border-blue-100">
                                            <span class="w-2 h-2 rounded-full bg-blue-500"></span> Sedang Diverifikasi
                                        </span>
                                    <?php elseif($b['status'] == 'CONFIRMED'): ?>
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Booking Sukses
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-bold border border-gray-200">
                                            <?= $b['status'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="h-px bg-gray-100 my-4"></div>

                            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                
                                <div class="w-full md:w-auto">
                                    <p class="text-xs text-gray-400 uppercase font-bold mb-1 tracking-wider">Total Pembayaran</p>
                                    <p class="text-xl font-bold text-blue-600">Rp <?= number_format($b['total_price'] + ($b['total_addons'] ?? 0)) ?></p>
                                </div>

                                <div class="flex w-full md:w-auto gap-3">
                                    <?php if($b['status'] == 'PENDING'): ?>
                                        
                                        <form action="/booking/cancel" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');" class="flex-1 md:flex-none">
                                            <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                                            <button class="w-full border border-red-200 text-red-600 bg-red-50 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-red-100 transition flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Batalkan
                                            </button>
                                        </form>

                                        <a href="/booking/payment?id=<?= $b['id'] ?>" class="flex-1 md:flex-none text-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-md shadow-blue-600/20 transition flex items-center justify-center gap-2">
                                            Bayar Sekarang
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </a>

                                    <?php elseif($b['status'] == 'CONFIRMED'): ?>
                                        
                                        <button class="flex-1 md:flex-none border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-50 transition">
                                            E-Voucher
                                        </button>
                                        <button class="flex-1 md:flex-none bg-green-600 text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-md hover:bg-green-700 transition">
                                            Beri Ulasan
                                        </button>

                                    <?php elseif($b['status'] == 'PAID'): ?>
                                        
                                        <button class="flex-1 md:flex-none border border-gray-200 text-gray-400 px-5 py-2.5 rounded-xl text-sm font-bold cursor-not-allowed bg-gray-50" disabled>
                                            Menunggu Konfirmasi
                                        </button>

                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>