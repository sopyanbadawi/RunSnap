<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelari - RunSnap</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            navy: '#0B1B3A',
                            teal: '#00C2B8',
                            tealHover: '#00AFA6',
                            orange: '#FF6A3D',
                            light: '#F6F8FB',
                            border: '#E6ECF2',
                            body: '#334155',
                            muted: '#64748B'
                        }
                    },
                    animation: {
                        'pulse-border': 'pulse-border 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        'pulse-border': {
                            '0%, 100%': { borderColor: 'rgba(0, 194, 184, 0.2)' },
                            '50%': { borderColor: 'rgba(0, 194, 184, 1)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            color: rgba(255, 255, 255, 0.4);
            font-weight: 900;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            pointer-events: none;
            text-shadow: 0px 4px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="bg-brand-light text-brand-body font-sans antialiased" x-data="{ sidebarOpen: false, profileDropdown: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-brand-border transition duration-300 transform lg:relative lg:translate-x-0 overflow-y-auto flex flex-col justify-between">
            <div>
                <!-- Brand -->
                <div class="flex items-center justify-center h-20 border-b border-brand-border">
                    <a href="/" class="text-2xl font-black text-brand-navy tracking-tighter flex items-center gap-1 group">
                        <svg class="w-7 h-7 text-brand-teal transform group-hover:scale-110 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Run<span class="text-brand-teal">Snap</span>
                    </a>
                </div>

                <!-- Nav Menu -->
                <nav class="mt-6 px-4 space-y-2">
                    <a href="/runner/dashboard" class="flex items-center px-4 py-3 rounded-xl bg-brand-light text-brand-teal font-bold transition-all border border-brand-border shadow-sm">
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
            
            <!-- Bottom Sidebar (Face Match CTA) -->
            <div class="px-4 pb-6 mt-10">
                <div class="bg-gradient-to-tr from-brand-navy to-[#183163] p-5 rounded-2xl border border-[#23427E] relative overflow-hidden group shadow-lg">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-brand-teal/20 rounded-full blur-2xl group-hover:bg-brand-teal/40 transition-all duration-500"></div>
                    <svg class="w-8 h-8 text-brand-teal mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h4 class="text-white text-sm font-bold mb-1">Face Recognition!</h4>
                    <p class="text-brand-light/70 text-xs mb-4">Temukan fotomu instan hanya dengan 1 selfie.</p>
                    <button class="w-full bg-brand-teal text-white text-xs font-bold py-2.5 rounded-lg hover:bg-brand-tealHover transition-colors flex justify-center items-center gap-1 shadow-[0_4px_14px_0_rgba(0,194,184,0.39)]">
                        Mulai Cari Foto
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto relative bg-brand-light">
            <!-- Background Decorations -->
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-brand-teal/5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

            <!-- Header -->
            <header class="h-20 bg-white/70 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-40 w-full">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-brand-navy hover:text-brand-teal lg:hidden mr-4 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-lg font-black text-brand-navy hidden sm:block">Beranda</h2>
                </div>

                <!-- Right Header Items -->
                <div class="flex items-center space-x-3 sm:space-x-5">
                    
                    @php $cartCount = count(session('cart', [])); @endphp
                    <!-- Cart/Purchases -->
                    <a href="/runner/cart" class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center bg-brand-orange text-white text-[10px] font-bold rounded-full border-2 border-white shadow-sm">{{ $cartCount }}</span>
                        @else
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white shadow-sm"></span>
                        @endif
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
                <div class="mb-10 text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-black text-brand-navy tracking-tight">Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-teal to-[#008f88]">{{ explode(' ', auth()->user()->name ?? 'Pelari')[0] }}</span>! 🏃‍♂️</h1>
                    <p class="text-brand-muted font-medium mt-2 text-lg">Siap menemukan momen terbaik di race terakhirmu?</p>
                </div>



                <!-- 2. Event Sedang Trending -->
                <div class="mb-14">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-6 gap-4">
                        <div>
                            <span class="text-brand-orange font-bold text-xs tracking-wider uppercase flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                                Terbaru di RunSnap
                            </span>
                            <h3 class="text-2xl font-black text-brand-navy mt-1 tracking-tight">Event Sedang Tren</h3>
                        </div>
                        <a href="/runner/events" class="text-sm font-bold text-brand-teal hover:text-white bg-brand-teal/10 hover:bg-brand-teal px-5 py-2.5 rounded-xl flex items-center transition-all duration-300 hover:shadow-lg hover:shadow-brand-teal/30 group">
                            Lihat Semua Event <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($trendingEvents as $event)
                        <a href="{{ route('runner.events.show', $event->id) }}" class="group bg-white border border-brand-border rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer flex flex-col h-full">
                            <div class="h-44 bg-gray-200 relative overflow-hidden">
                                <img src="{{ asset('storage/' . $event->banner_image) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=600'" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="Event Banner">
                                <div class="absolute inset-0 bg-gradient-to-t from-brand-navy/90 via-brand-navy/20 to-transparent"></div>
                                <div class="absolute top-3 right-3 bg-brand-navy/90 backdrop-blur-sm text-white text-[10px] font-black px-2.5 py-1 rounded-md shadow-sm">
                                    Paling Dicari
                                </div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h4 class="font-black text-lg mb-0.5 leading-tight group-hover:text-brand-teal transition-colors">{{ $event->name }}</h4>
                                    <p class="text-xs text-gray-300 flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ $event->lokasi ?? 'Lokasi Belum Ditentukan' }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-5 bg-white flex justify-between items-center mt-auto border-t border-brand-border/50">
                                <div>
                                    <p class="text-[10px] text-brand-muted font-bold mb-0.5">TANGGAL</p>
                                    <p class="text-sm font-bold text-brand-navy">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-brand-muted font-bold mb-0.5">FOTO TERSEDIA</p>
                                    <p class="text-sm font-black text-brand-teal bg-brand-teal/10 px-2 py-0.5 rounded inline-block">{{ number_format($event->photos->count() ?? 0, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-16 bg-white border-2 border-brand-border border-dashed rounded-3xl shadow-sm">
                            <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-brand-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-brand-navy font-bold text-lg">Belum ada event saat ini.</p>
                            <p class="text-brand-muted mt-1 text-sm text-center max-w-sm">Event lari terbaru akan segera hadir di sini. Silakan periksa kembali nanti.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- 3. Preview Galeri Foto / Koleksi Foto Terbarumu -->
                <div>
                    <h3 class="text-2xl font-black text-brand-navy mb-6 tracking-tight">Galeri Foto Terbarumu</h3>
                    
                    <!-- Masonry-style Grid Container -->
                    <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
                        @forelse($recentPhotos as $purchase)
                        <!-- Photo Item -->
                        <div class="break-inside-avoid group relative rounded-2xl overflow-hidden cursor-pointer bg-gray-100 border border-brand-border shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <img src="{{ asset('storage/' . $purchase->photo->original_path) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=600'" class="w-full h-auto object-cover" alt="Run Preview">
                            <div class="absolute inset-0 bg-brand-navy/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-5">
                                <div class="flex justify-between items-start">
                                    <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded">{{ $purchase->photo->event->name ?? 'Event Lari' }}</span>
                                    <div class="bg-green-500 text-white text-xs font-black px-2.5 py-1.5 rounded shadow">Lunas</div>
                                </div>
                                <div>
                                    <a href="{{ asset('storage/' . $purchase->photo->original_path) }}" download class="block w-full text-center mt-3 bg-white text-brand-navy font-bold py-2 rounded-lg text-sm hover:bg-brand-teal hover:text-white transition-colors">Unduh Resolusi Asli</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="w-full break-inside-avoid col-span-full">
                            <div class="text-center py-12 bg-white border border-brand-border rounded-2xl shadow-sm">
                                <svg class="w-12 h-12 text-brand-muted mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-brand-navy font-bold">Belum ada foto yang dibeli.</p>
                                <p class="text-brand-muted text-sm mt-1">Gunakan fitur pencarian untuk menemukan foto lari Anda.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    
                    <div class="text-center mt-8">
                        <button class="text-brand-muted hover:text-brand-teal font-bold text-sm transition-colors border-b-2 border-transparent hover:border-brand-teal pb-1">Tampilkan Lebih Banyak</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
