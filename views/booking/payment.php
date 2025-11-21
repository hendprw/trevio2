<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-xl mx-auto bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        
        <div class="bg-blue-600 p-8 text-center text-white">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h1 class="text-2xl font-bold mb-2">Menunggu Pembayaran</h1>
            <p class="text-blue-100">Selesaikan pembayaran sebelum <br> <span class="font-bold text-white"><?= date('d M Y H:i', strtotime('+2 hours')) ?></span></p>
            <h2 class="text-3xl font-bold mt-6">Rp <?= number_format($booking['total_price'] + ($booking['total_addons'] ?? 0)) ?></h2>
        </div>

        <div class="p-8">
            <div class="mb-8">
                <h3 class="font-bold text-gray-900 mb-2">Metode: <?= str_replace('_', ' ', $booking['payment_method']) ?></h3>
                
                <?php if($booking['payment_method'] == 'BANK_TRANSFER'): ?>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="text-sm text-gray-500 mb-1">Bank BCA</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-mono font-bold text-gray-800">123 456 7890</span>
                            <button class="text-blue-600 text-xs font-bold">COPY</button>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">a.n PT Trevio Indonesia</p>
                    </div>
                <?php elseif($booking['payment_method'] == 'E_WALLET'): ?>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="text-sm text-gray-500 mb-2">Transfer ke Nomor OVO/Dana:</p>
                        <span class="text-xl font-mono font-bold text-gray-800 block mb-1">0812 3456 7890</span>
                        <p class="text-xs text-gray-400">a.n Trevio Admin</p>
                    </div>
                <?php elseif($booking['payment_method'] == 'QRIS'): ?>
                    <div class="text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" class="w-48 h-48 mx-auto mb-2">
                        <p class="text-xs text-gray-500">Scan menggunakan GoPay, OVO, Shopee, atau BCA Mobile</p>
                    </div>
                <?php endif; ?>
            </div>

            <form action="/booking/upload" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                <label class="block text-sm font-bold text-gray-700 mb-2">Upload Bukti Transfer</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer relative mb-6">
                    <input type="file" name="proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                </div>
                <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg transition">
                    Saya Sudah Bayar
                </button>
            </form>
            
            <a href="/my-bookings" class="block text-center text-gray-500 text-sm font-bold mt-4 hover:text-gray-900">Cek Status Pesanan</a>
        </div>
    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>