<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="/owner/dashboard" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Properti</h1>
                    <p class="text-sm text-gray-500">Perbarui informasi dan layanan hotel Anda.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <form action="/owner/update-hotel" method="POST" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
                    <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                    
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Informasi Dasar</h3>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Hotel</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($hotel['name']) ?>" class="w-full border border-gray-200 rounded-xl p-3 font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kota / Wilayah</label>
                                <div class="relative">
                                    <select name="city" class="w-full border border-gray-200 rounded-xl p-3 font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-white cursor-pointer">
                                        <?php 
                                        $cities = ['Bali', 'Jakarta', 'Bandung', 'Yogyakarta', 'Surabaya', 'Semarang', 'Medan', 'Makassar', 'Malang', 'Lombok', 'Bogor'];
                                        foreach($cities as $city): 
                                            $selected = ($hotel['city'] == $city) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $city ?>" <?= $selected ?>><?= $city ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Update Thumbnail</label>
                                <input type="file" name="thumbnail" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-xl cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Lengkap</label>
                            <textarea name="address" rows="2" class="w-full border border-gray-200 rounded-xl p-3 font-semibold text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition"><?= htmlspecialchars($hotel['address']) ?></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Deskripsi Hotel</label>
                            <textarea name="description" rows="5" class="w-full border border-gray-200 rounded-xl p-3 text-sm text-gray-600 focus:ring-2 focus:ring-blue-500 outline-none transition"><?= htmlspecialchars($hotel['description']) ?></textarea>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-600/20 transition transform active:scale-95 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Galeri Foto</h3>
                    </div>

                    <?php if(empty($hotel['gallery'])): ?>
                        <div class="text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <p class="text-gray-400 text-sm">Belum ada galeri tambahan.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <?php foreach($hotel['gallery'] as $img): ?>
                                <div class="relative group h-32 rounded-xl overflow-hidden">
                                    <img src="/<?= $img['image_path'] ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-8">
                
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Thumbnail Saat Ini</h3>
                    <div class="rounded-xl overflow-hidden h-48 bg-gray-100 relative border border-gray-200">
                        <img src="/<?= $hotel['thumbnail'] ?>" class="w-full h-full object-cover">
                        <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-1 rounded backdrop-blur-sm">Main Image</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 bg-green-50 text-green-600 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Add-ons</h3>
                            <p class="text-xs text-gray-500">Layanan tambahan berbayar</p>
                        </div>
                    </div>
                    
                    <ul class="space-y-3 mb-6 max-h-60 overflow-y-auto no-scrollbar">
                        <?php if(isset($addons) && count($addons) > 0): ?>
                            <?php foreach($addons as $ad): ?>
                            <li class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100 group">
                                <div>
                                    <span class="font-bold text-gray-800 text-sm block"><?= htmlspecialchars($ad['name']) ?></span>
                                    <span class="text-xs text-green-600 font-bold">Rp <?= number_format($ad['price']) ?></span>
                                </div>
                                <form action="/owner/delete-addon" method="POST">
                                    <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                                    <input type="hidden" name="addon_id" value="<?= $ad['id'] ?>">
                                    <button class="w-7 h-7 bg-white border border-gray-200 rounded-full text-red-400 hover:bg-red-50 hover:text-red-600 hover:border-red-200 flex items-center justify-center transition" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-center text-gray-400 text-xs py-4">Belum ada add-ons.</li>
                        <?php endif; ?>
                    </ul>

                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                        <p class="text-xs font-bold text-blue-800 mb-3 uppercase tracking-wide">Tambah Baru</p>
                        <form action="/owner/add-addon" method="POST" class="space-y-3">
                            <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                            <input type="text" name="name" placeholder="Nama (ex: Extra Bed)" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 outline-none" required>
                            <div class="flex gap-2">
                                <input type="number" name="price" placeholder="Harga (Rp)" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 outline-none" required>
                                <button class="bg-gray-900 text-white text-xs font-bold px-4 rounded-lg hover:bg-gray-800 transition flex items-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>