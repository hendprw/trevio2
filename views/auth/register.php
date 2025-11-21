<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-[calc(100vh-80px)] flex items-center justify-center p-4 md:p-8 bg-gray-50">
    
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex max-w-5xl w-full border border-gray-100">
        
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center relative">
            
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm">Bergabunglah dengan komunitas traveler terbesar.</p>
            </div>

            <form action="/register" method="POST" class="space-y-5">
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5 ml-1">Nama Lengkap</label>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500 focus-within:bg-white transition">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <input type="text" name="name" class="w-full bg-transparent outline-none text-sm font-semibold text-gray-700 placeholder-gray-400" placeholder="John Doe" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5 ml-1">Email Address</label>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500 focus-within:bg-white transition">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        <input type="email" name="email" class="w-full bg-transparent outline-none text-sm font-semibold text-gray-700 placeholder-gray-400" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5 ml-1">Password</label>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500 focus-within:bg-white transition">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <input type="password" name="password" class="w-full bg-transparent outline-none text-sm font-semibold text-gray-700 placeholder-gray-400" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5 ml-1">Daftar Sebagai</label>
                    <div class="relative">
                        <select name="role" class="w-full appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-3.5 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 font-semibold text-sm cursor-pointer">
                            <option value="user">👤 Wisatawan (Guest)</option>
                            <option value="owner">🏨 Pemilik Hotel (Partner)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1 ml-1">*Pilih "Pemilik Hotel" jika Anda ingin menyewakan properti.</p>
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-600/30 transition transform active:scale-[0.98] mt-2">
                    Buat Akun
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">Sudah punya akun? <a href="/login" class="text-blue-600 font-bold hover:text-blue-700 transition">Masuk di sini</a></p>
            </div>
        </div>

        <div class="hidden md:block w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-transparent to-transparent flex flex-col justify-end p-12 text-white">
                <h2 class="text-4xl font-bold mb-4 leading-tight">Mulai Perjalanan Anda</h2>
                <p class="text-blue-100 opacity-90 text-sm leading-relaxed">
                    "Dunia adalah buku, dan mereka yang tidak melakukan perjalanan hanya membaca satu halaman."
                </p>
                <div class="flex gap-2 mt-6">
                    <div class="h-1 w-8 bg-white rounded-full"></div>
                    <div class="h-1 w-2 bg-white/30 rounded-full"></div>
                    <div class="h-1 w-2 bg-white/30 rounded-full"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>