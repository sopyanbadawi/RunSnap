<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil & Data Diri - RunSnap</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: {
                        brand: {
                            navy: '#0B1B3A', teal: '#00C2B8', tealHover: '#00AFA6', orange: '#FF6A3D', light: '#F6F8FB', border: '#E6ECF2', body: '#334155', muted: '#64748B'
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-brand-light text-brand-body font-sans antialiased" x-data="{ sidebarOpen: false, profileDropdown: false }">

    <div class="flex h-screen overflow-hidden">
        
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-brand-border transition duration-300 transform lg:relative lg:translate-x-0 overflow-y-auto flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-center h-20 border-b border-brand-border">
                    <a href="/" class="text-2xl font-black text-brand-navy tracking-tighter flex items-center gap-1 group">
                        <svg class="w-7 h-7 text-brand-teal transform group-hover:scale-110 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Run<span class="text-brand-teal">Snap</span>
                    </a>
                </div>

                <nav class="mt-6 px-4 space-y-2">
                    <a href="/runner/dashboard" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda Pelari
                    </a>
                    <a href="/runner/events" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Event
                    </a>
                    <a href="/runner/gallery" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Galeri Foto Saya
                    </a>
                    <a href="/runner/transactions" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Riwayat Pembelian
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto relative bg-brand-light">
            <!-- Header -->
            <header class="h-20 bg-white/70 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-40 w-full">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-brand-navy hover:text-brand-teal lg:hidden mr-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-lg font-black text-brand-navy hidden sm:block">Akun Saya</h2>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-5">
                    
                    <!-- Cart/Purchases -->
                    <a href="/runner/cart" class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white"></span>
                    </a>

                    <!-- Profile Dropdown CSS Based -->
                    <div class="relative group pb-4 -mb-4">
                        <button class="flex items-center space-x-2 sm:space-x-3 focus:outline-none bg-brand-light p-1.5 pr-3 sm:pr-4 rounded-full border border-brand-border hover:border-brand-teal transition-colors shadow-sm cursor-pointer">
                            <div class="w-8 h-8 bg-brand-teal/20 text-brand-teal rounded-full flex items-center justify-center font-bold text-sm">
                                {{ substr(auth()->user()->name ?? 'R U', 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-brand-navy hidden sm:block">{{ auth()->user()->name ?? 'Pelari Runner' }}</span>
                            <svg class="w-4 h-4 text-brand-muted hidden sm:block transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div class="absolute right-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg border border-brand-border py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100">
                            <a href="/runner/profile" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Profil & Data Diri</a>
                            <a href="/runner/settings" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Pengaturan Akun</a>
                            <div class="border-t border-brand-border my-1"></div>
                            @auth
                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">Logout</button>
                            </form>
                            @else
                            <a href="/login" class="block px-4 py-2 text-sm text-brand-navy hover:bg-brand-light font-bold">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-4 sm:p-6 lg:p-10 w-full max-w-7xl mx-auto flex-1 relative z-10">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-brand-navy tracking-tight">Profil & Data Diri</h1>
                    <p class="text-brand-muted font-medium mt-1">Kelola informasi pribadi dan data pengenalan wajah Anda.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left: Face Recognition Data -->
                    <div class="lg:col-span-1">
                        <div class="bg-white border border-brand-border rounded-2xl shadow-sm p-6 text-center h-full flex flex-col items-center justify-center">
                            <div class="w-24 h-24 bg-brand-teal/10 rounded-full flex items-center justify-center mb-4 relative">
                                <svg class="w-12 h-12 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                            </div>
                            <h3 class="font-bold text-brand-navy text-lg">Data Wajah Tersimpan</h3>
                            <p class="text-xs text-brand-muted mt-2 mb-6">AI RunSnap menggunakan data ini untuk menemukan foto Anda secara otomatis dari ribuan foto event.</p>
                            
                            <button class="w-full bg-brand-light text-brand-teal font-bold py-2.5 rounded-xl hover:bg-brand-teal/20 transition-colors border border-brand-teal/30">
                                Perbarui Foto Selfie
                            </button>
                        </div>
                    </div>

                    <!-- Right: Personal Information Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white border border-brand-border rounded-2xl shadow-sm p-6 sm:p-8">
                            <h3 class="text-lg font-bold text-brand-navy mb-6 border-b border-brand-border pb-4">Informasi Pribadi</h3>
                            
                            <form>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label class="block text-xs font-bold text-brand-muted uppercase tracking-wider mb-2">Nama Lengkap</label>
                                        <input type="text" value="Pelari Runner" class="w-full bg-brand-light border border-brand-border rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-teal focus:border-brand-teal focus:outline-none transition-all font-semibold text-brand-navy">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-brand-muted uppercase tracking-wider mb-2">Email</label>
                                        <input type="email" value="runner@example.com" class="w-full bg-brand-light border border-brand-border rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-teal focus:border-brand-teal focus:outline-none transition-all font-semibold text-brand-navy">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label class="block text-xs font-bold text-brand-muted uppercase tracking-wider mb-2">Nomor WhatsApp</label>
                                        <input type="tel" value="081234567890" class="w-full bg-brand-light border border-brand-border rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-teal focus:border-brand-teal focus:outline-none transition-all font-semibold text-brand-navy">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-brand-muted uppercase tracking-wider mb-2">Jenis Kelamin</label>
                                        <select class="w-full bg-brand-light border border-brand-border rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-teal focus:border-brand-teal focus:outline-none transition-all font-semibold text-brand-navy appearance-none">
                                            <option value="l" selected>Laki-laki</option>
                                            <option value="p">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-8">
                                    <label class="block text-xs font-bold text-brand-muted uppercase tracking-wider mb-2">Alamat Domisili</label>
                                    <textarea rows="3" class="w-full bg-brand-light border border-brand-border rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-teal focus:border-brand-teal focus:outline-none transition-all font-semibold text-brand-navy">Jl. Sudirman No. 123, Jakarta Pusat</textarea>
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button type="button" class="px-6 py-3 rounded-xl font-bold text-brand-muted hover:bg-brand-light transition-colors">Batal</button>
                                    <button type="submit" class="bg-brand-navy text-white px-8 py-3 rounded-xl font-bold hover:bg-[#152A50] transition-colors shadow-lg shadow-brand-navy/20">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

</body>
</html>
