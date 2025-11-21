<?php include __DIR__.'/../layout_head.php'; ?>

<div class="min-h-[calc(100vh-80px)] flex items-center justify-center p-4 md:p-8 bg-gray-50">
    
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex max-w-4xl w-full border border-gray-100">
        
        <div class="hidden md:block w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-900/40 to-transparent flex flex-col justify-end p-10 text-white">
                <div class="mb-4 bg-white/20 backdrop-blur-sm w-fit px-3 py-1 rounded-full border border-white/30">
                    <span class="text-xs font-bold tracking-wider uppercase">Trevio Member</span>
                </div>
                <h2 class="text-3xl font-bold mb-3 leading-tight">Kembali <br>Berpetualang</h2>
                <p class="text-blue-100 text-sm opacity-90 leading-relaxed">
                    Akses ribuan hotel eksklusif dan kelola perjalanan Anda dengan mudah dalam satu dasbor.
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center relative">
            
            <div class="absolute top-0 right-0 p-4 md:hidden opacity-10">
                <svg class="w-24 h-24 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>

            <div class="text-center md:text-left mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h1>
                <p class="text-gray-500 text-sm">Silakan masukkan detail akun Anda untuk melanjutkan.</p>
            </div>

            <form method="POST" class="space-y-5">
                
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1.5 ml-1">Email Address</label>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500 focus-within:bg-white transition duration-200">
                        <svg class="w-5 h-5 text-gray-400 mr-3 group-focus-within:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        <input type="email" name="email" class="w-full bg-transparent outline-none text-sm text-gray-700 font-semibold placeholder-gray-400" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="group">
                    <div class="flex justify-between items-center mb-1.5 ml-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase">Password</label>
                        <a href="#" class="text-xs text-blue-600 font-bold hover:underline">Lupa Password?</a>
                    </div>
                    <div class="flex items-center bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-blue-500 focus-within:bg-white transition duration-200">
                        <svg class="w-5 h-5 text-gray-400 mr-3 group-focus-within:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <input type="password" name="password" class="w-full bg-transparent outline-none text-sm text-gray-700 font-semibold placeholder-gray-400" placeholder="••••••••" required>
                    </div>
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-600/30 transition transform active:scale-[0.98] flex justify-center items-center gap-2">
                    <span>Masuk Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-2 bg-white text-gray-400 font-medium">Atau lanjutkan dengan</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center gap-2 border border-gray-200 py-2.5 rounded-xl hover:bg-gray-50 transition">
                    <svg class="w-5 h-5" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                    <span class="text-sm font-bold text-gray-600">Google</span>
                </button>
                <button class="flex items-center justify-center gap-2 border border-gray-200 py-2.5 rounded-xl hover:bg-gray-50 transition">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    <span class="text-sm font-bold text-gray-600">Facebook</span>
                </button>
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">Belum punya akun? <a href="/register" class="text-blue-600 font-bold hover:text-blue-700 transition">Daftar Sekarang</a></p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__.'/../layout_foot.php'; ?>