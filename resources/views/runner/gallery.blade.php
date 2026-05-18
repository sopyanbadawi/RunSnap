<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto Saya - RunSnap</title>
    
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
                    <a href="/runner/gallery" class="flex items-center px-4 py-3 rounded-xl bg-brand-light text-brand-teal font-bold transition-all border border-brand-border shadow-sm">
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
                    <h2 class="text-lg font-black text-brand-navy hidden sm:block">Koleksi Pribadi</h2>
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

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-10 w-full max-w-7xl mx-auto flex-1 relative z-10">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-brand-navy tracking-tight">Galeri Foto Saya</h1>
                        <p class="text-brand-muted font-medium mt-1">Semua momen epik yang telah Anda beli dengan resolusi asli tanpa watermark.</p>
                    </div>
                    
                    <button class="bg-brand-navy text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#152A50] transition-colors shadow-lg shadow-brand-navy/20 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Semua (ZIP)
                    </button>
                </div>

                <!-- Masonry-style Grid Container -->
                <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
                    @forelse ($purchasedPhotos as $purchase)
                    <div class="break-inside-avoid group relative rounded-2xl overflow-hidden cursor-pointer bg-white border border-brand-border shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <!-- User owns this photo, so no watermark -->
                        <img src="{{ asset('storage/' . $purchase->photo->original_path) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=600'" class="w-full h-auto object-cover" alt="My Photo">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-navy/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <h4 class="text-white font-bold text-sm mb-1">{{ $purchase->photo->event->name ?? 'Event Lari' }}</h4>
                            <div class="flex gap-2 mt-2">
                                <a href="{{ asset('storage/' . $purchase->photo->original_path) }}" download class="flex-1 bg-brand-teal text-white text-xs font-bold py-2 rounded-lg hover:bg-brand-tealHover transition-colors flex justify-center items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg> Unduh HD
                                </a>
                                <button class="bg-white/20 hover:bg-white/40 backdrop-blur-md text-white p-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div class="absolute top-3 right-3">
                            <span class="bg-green-500/90 backdrop-blur-sm text-white text-[10px] font-black px-2 py-1 rounded shadow-sm">Lunas</span>
                        </div>
                    </div>
                    @empty
                    <div class="w-full break-inside-avoid col-span-full">
                        <div class="text-center py-16 bg-white border border-brand-border rounded-2xl shadow-sm">
                            <svg class="w-16 h-16 text-brand-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-xl font-black text-brand-navy mb-2">Belum Ada Koleksi Foto</p>
                            <p class="text-brand-muted mb-6">Cari foto lari terbaik Anda dan beli untuk menyimpannya di sini.</p>
                            <a href="/runner/events" class="inline-block bg-brand-teal text-white font-bold px-6 py-3 rounded-xl hover:bg-brand-tealHover transition-colors shadow-md shadow-brand-teal/20">Cari Event Lari</a>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    {{ $purchasedPhotos->links() }}
                </div>

            </div>
        </main>
    </div>

</body>
</html>
