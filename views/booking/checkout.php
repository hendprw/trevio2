<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Konfirmasi Pesanan</h1>
            <p class="text-gray-500 text-sm">Lengkapi data tamu dan pembayaran untuk menyelesaikan pesanan.</p>
        </div>
        
        <form action="/booking/store" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <input type="hidden" name="hotel_id" value="<?= $hotel_id ?>">
            <input type="hidden" name="room_type_id" value="<?= $room_id ?>">
            <input type="hidden" name="room_price" value="<?= $selectedRoom['price'] ?>">
            <input type="hidden" name="check_in" value="<?= $checkIn ?>">
            <input type="hidden" name="check_out" value="<?= $checkOut ?>">

            <div class="md:col-span-2 space-y-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs">1</span>
                        Data Tamu
                    </h3>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                        <input type="text" name="guest_name" class="w-full border border-gray-200 rounded-xl p-3 font-semibold outline-none focus:ring-2 focus:ring-blue-500 transition" 
                               value="<?= $_SESSION['user']['name'] ?>" placeholder="Nama tamu saat check-in" required>
                        <p class="text-xs text-gray-400 mt-1 ml-1">Pastikan nama sesuai KTP/Paspor tamu yang menginap.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs">2</span>
                        Metode Pembayaran
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition group">
                            <input type="radio" name="payment_method" value="BANK_TRANSFER" class="w-5 h-5 text-blue-600 focus:ring-blue-500" checked required>
                            <div>
                                <span class="block font-bold text-gray-800 group-hover:text-blue-700">Bank Transfer</span>
                                <span class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI (Cek Manual)</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition group">
                            <input type="radio" name="payment_method" value="E_WALLET" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                            <div>
                                <span class="block font-bold text-gray-800 group-hover:text-blue-700">E-Wallet</span>
                                <span class="text-xs text-gray-500">GoPay, OVO, Dana, ShopeePay</span>
                            </div>
                        </label>
                    </div>
                </div>

                <?php if(!empty($addons)): ?>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs">3</span>
                        Layanan Tambahan
                    </h3>
                    <div class="space-y-3">
                        <?php foreach($addons as $ad): ?>
                        <label class="flex items-center justify-between p-3 border border-gray-100 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="addons[]" value="<?= $ad['name'].'|'.$ad['price'] ?>" class="addon-checkbox w-5 h-5 text-blue-600 rounded focus:ring-blue-500" data-price="<?= $ad['price'] ?>" onchange="calculateTotal()">
                                <span class="font-medium text-gray-700"><?= htmlspecialchars($ad['name']) ?></span>
                            </div>
                            <span class="text-sm font-bold text-blue-600">+ Rp <?= number_format($ad['price']) ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 text-lg">Rincian Harga</h3>
                    
                    <div class="flex gap-3 mb-5 pb-5 border-b border-gray-100">
                        <img src="/<?= htmlspecialchars($hotel['thumbnail']) ?>" class="w-16 h-16 rounded-lg object-cover bg-gray-200">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-sm text-gray-900 truncate"><?= htmlspecialchars($hotel['name']) ?></p>
                            <p class="text-xs text-gray-500 truncate"><?= htmlspecialchars($selectedRoom['name']) ?></p>
                            <div class="flex items-center gap-1 text-xs text-gray-500 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span><?= date('d M', strtotime($checkIn)) ?> - <?= date('d M', strtotime($checkOut)) ?></span>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $diff = strtotime($checkOut) - strtotime($checkIn);
                        $days = round($diff / (60 * 60 * 24));
                        if($days < 1) $days = 1;
                        $roomTotal = $selectedRoom['price'] * $days;
                    ?>

                    <div class="space-y-3 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Harga Kamar (<?= $days ?> malam)</span>
                            <span class="font-medium">Rp <?= number_format($roomTotal) ?></span>
                        </div>
                        <div class="flex justify-between text-green-600" id="addon-row" style="display:none;">
                            <span>Add-ons</span>
                            <span class="font-bold" id="addon-price">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-400 text-xs">
                            <span>Pajak & Biaya Layanan</span>
                            <span>Termasuk</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center mb-6">
                        <div>
                            <span class="block text-xs text-gray-500 font-bold uppercase">Total Bayar</span>
                            <span class="font-bold text-2xl text-blue-600" id="grand-total">Rp <?= number_format($roomTotal) ?></span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-600/20 transition transform active:scale-95 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Lanjut Pembayaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const basePrice = <?= $roomTotal ?>;
    
    function calculateTotal() {
        let addonTotal = 0;
        const checkboxes = document.querySelectorAll('.addon-checkbox:checked');
        
        checkboxes.forEach(cb => {
            addonTotal += parseFloat(cb.dataset.price);
        });

        // Update Tampilan
        const addonRow = document.getElementById('addon-row');
        const addonPriceEl = document.getElementById('addon-price');
        const grandTotalEl = document.getElementById('grand-total');

        if(addonTotal > 0) {
            addonRow.style.display = 'flex';
            addonPriceEl.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(addonTotal);
        } else {
            addonRow.style.display = 'none';
        }

        const grandTotal = basePrice + addonTotal;
        grandTotalEl.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }
</script>

<?php include __DIR__.'/../layout_foot.php'; ?>