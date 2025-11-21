<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-5xl mx-auto">
        
        <div class="flex items-center gap-4 mb-8">
            <a href="/owner/dashboard" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Properti Baru</h1>
                <p class="text-sm text-gray-500">Lengkapi detail hotel Anda untuk mulai berjualan.</p>
            </div>
        </div>

        <form action="/owner/create-hotel" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs">1</span>
                        Informasi Umum
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Hotel</label>
                            <input type="text" name="name" class="w-full border border-gray-200 rounded-xl p-3 font-semibold focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Trevio Grand Hotel" required>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kota / Wilayah</label>
                                <div class="relative">
                                    <select name="city" class="w-full border border-gray-200 rounded-xl p-3 font-semibold focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-white cursor-pointer" required>
                                        <option value="" disabled selected>Pilih Kota</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Jakarta">Jakarta</option>
                                        <option value="Bandung">Bandung</option>
                                        <option value="Yogyakarta">Yogyakarta</option>
                                        <option value="Surabaya">Surabaya</option>
                                        <option value="Semarang">Semarang</option>
                                        <option value="Medan">Medan</option>
                                        <option value="Makassar">Makassar</option>
                                        <option value="Malang">Malang</option>
                                        <option value="Lombok">Lombok</option>
                                        <option value="Bogor">Bogor</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kode Pos</label>
                                <input type="text" name="zip" class="w-full border border-gray-200 rounded-xl p-3 font-semibold focus:ring-2 focus:ring-blue-500 outline-none" placeholder="12345">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat Lengkap</label>
                            <textarea name="address" rows="2" class="w-full border border-gray-200 rounded-xl p-3 font-semibold focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Jl. Jendral Sudirman No..." required></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Deskripsi Hotel</label>
                            <textarea name="description" rows="5" class="w-full border border-gray-200 rounded-xl p-3 text-sm text-gray-600 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ceritakan tentang keunikan hotel Anda, dekat dengan objek wisata apa, dll."></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs">2</span>
                        Fasilitas & Layanan
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <?php 
                        $facilities = ['Free WiFi', 'Swimming Pool', 'Parking', 'Restaurant', '24-Hour Front Desk', 'Gym / Fitness', 'Spa', 'AC', 'Elevator', 'Meeting Room', 'Airport Shuttle', 'Bar'];
                        foreach($facilities as $fac): 
                        ?>
                        <label class="flex items-center gap-3 p-3 border border-gray-100 rounded-xl cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition">
                            <input type="checkbox" name="facilities[]" value="<?= $fac ?>" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-600"><?= $fac ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Foto Utama (Thumbnail)</h3>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:bg-gray-50 transition group">
                        <input type="file" name="thumbnail" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required onchange="previewImage(this, 'thumb-preview')">
                        <div id="thumb-preview-container">
                            <svg class="w-10 h-10 text-gray-400 mx-auto mb-2 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm text-gray-500 font-medium">Klik untuk upload cover</p>
                            <p class="text-xs text-gray-400 mt-1">JPG/PNG, Max 2MB</p>
                        </div>
                        <img id="thumb-preview" class="hidden w-full h-40 object-cover rounded-xl mt-2">
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Galeri Foto</h3>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:bg-gray-50 transition group">
                        <input type="file" name="gallery[]" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileCount(this)">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-2 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <p class="text-sm text-gray-500 font-medium">Upload banyak foto</p>
                        <p id="gallery-count" class="text-xs text-blue-600 font-bold mt-2 hidden">0 file dipilih</p>
                    </div>
                    <p class="text-xs text-gray-400 mt-3 px-2">Pilih beberapa foto sekaligus untuk menampilkan interior kamar, lobby, dll.</p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-600/30 transition transform active:scale-95 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan & Terbitkan
                    </button>
                    <a href="/owner/dashboard" class="block text-center text-sm text-gray-500 font-bold mt-4 hover:text-gray-800">Batal</a>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, imgId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(imgId).classList.remove('hidden');
            document.getElementById('thumb-preview-container').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function updateFileCount(input) {
    const countSpan = document.getElementById('gallery-count');
    if(input.files.length > 0) {
        countSpan.textContent = input.files.length + " foto dipilih";
        countSpan.classList.remove('hidden');
    } else {
        countSpan.classList.add('hidden');
    }
}
</script>

<?php include __DIR__.'/../layout_foot.php'; ?>