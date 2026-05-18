<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Event - RunSnap</title>
    
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
                    <a href="/runner/events" class="flex items-center px-4 py-3 rounded-xl bg-brand-light text-brand-teal font-bold transition-all border border-brand-border shadow-sm">
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
                    <!-- Header Search -->
                    <div class="hidden md:flex items-center bg-brand-light border border-brand-border rounded-full px-4 py-2 w-96 focus-within:border-brand-teal focus-within:ring-2 focus-within:ring-brand-teal/20 transition-all">
                        <svg class="w-4 h-4 text-brand-muted mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" class="bg-transparent border-none focus:outline-none w-full text-sm font-medium text-brand-navy" placeholder="Cari nama event lari...">
                    </div>
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
                        <h1 class="text-3xl font-black text-brand-navy tracking-tight">Cari Event Lari</h1>
                        <p class="text-brand-muted font-medium mt-1">Jelajahi ratusan event marathon dan fun run untuk menemukan fotomu.</p>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 w-full md:w-auto">
                        <select class="bg-white border border-brand-border text-sm font-bold text-brand-navy rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:border-brand-teal">
                            <option>Semua Lokasi</option>
                            <option>Jakarta</option>
                            <option>Bali</option>
                <!-- Breadcrumbs -->
                <nav class="flex mb-6 text-sm font-bold text-brand-muted" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('runner.dashboard') }}" class="hover:text-brand-teal transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <a href="{{ route('runner.events') }}" class="hover:text-brand-teal transition-colors">Semua Event</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <span class="text-brand-navy">{{ $event->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Event Header Banner -->
                <div class="bg-white rounded-3xl shadow-sm border border-brand-border overflow-hidden mb-10 relative">
                    <div class="h-64 sm:h-80 w-full relative">
                        <img src="{{ asset('storage/' . $event->banner_image) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=1200'" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-navy via-brand-navy/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 w-full p-6 sm:p-10 text-white flex flex-col sm:flex-row justify-between items-start sm:items-end gap-6">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="bg-brand-teal text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                    <span class="bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/20 flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ $event->lokasi ?? 'Lokasi Belum Ditentukan' }}
                                    </span>
                                </div>
                                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black mb-2">{{ $event->name }}</h1>
                                <p class="text-brand-light/80 text-sm max-w-2xl">{{ $event->description ?? 'Temukan foto-foto terbaik Anda dari event ini.' }}</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 text-center min-w-[120px]">
                                <p class="text-xs text-brand-light/70 font-bold mb-1 uppercase tracking-wider">Total Foto</p>
                                <p class="text-3xl font-black text-brand-teal">{{ number_format($event->photos->count() ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 1. Kotak Pencarian Cerdas (AI & BIB) khusus untuk event ini -->
                <div class="mb-12">
                    <div x-data="{ tab: 'ai' }" class="bg-white rounded-3xl shadow-sm border border-brand-border p-5 md:p-8 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
                        <!-- Decorative background -->
                        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-teal/5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

                        <div class="text-center md:text-left mb-6 relative z-10">
                            <h2 class="text-2xl font-black text-brand-navy tracking-tight">Cari Fotomu di Event Ini</h2>
                            <p class="text-brand-muted text-sm mt-1">Gunakan selfie atau nomor BIB untuk menemukan foto dengan cepat.</p>
                        </div>

                        <!-- Tabs -->
                        <div class="flex p-1.5 bg-brand-light rounded-2xl mb-8 relative z-10 max-w-md mx-auto md:mx-0">
                            <button @click="tab = 'ai'" :class="tab === 'ai' ? 'bg-white shadow-md text-brand-teal scale-[1.02]' : 'text-brand-muted hover:text-brand-navy'" class="flex-1 py-3 rounded-xl font-bold text-sm transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Pencarian AI (Selfie)
                            </button>
                            <button @click="tab = 'bib'" :class="tab === 'bib' ? 'bg-white shadow-md text-brand-navy scale-[1.02]' : 'text-brand-muted hover:text-brand-navy'" class="flex-1 py-3 rounded-xl font-bold text-sm transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                Nomor BIB
                            </button>
                        </div>

                        <!-- AI Search Content -->
                        <div x-show="tab === 'ai'" x-transition.opacity class="flex flex-col md:flex-row gap-6 items-center relative z-10">
                            <div class="flex-1 w-full relative">
                                <label class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-brand-teal/50 rounded-2xl cursor-pointer bg-brand-teal/5 hover:bg-brand-teal/10 hover:border-brand-teal transition-all duration-300 group shadow-sm hover:shadow-inner">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 group-hover:bg-brand-teal group-hover:text-white transition-all duration-300 text-brand-teal">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                        </div>
                                        <p class="text-sm font-bold text-brand-navy">Upload Selfie Anda</p>
                                        <p class="text-xs text-brand-muted mt-1">Sistem AI akan mencari wajah Anda di event ini</p>
                                    </div>
                                    <input type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            <button class="w-full md:w-auto h-36 px-10 bg-brand-teal text-white rounded-2xl font-black text-lg hover:bg-brand-tealHover shadow-lg shadow-brand-teal/30 transition-all duration-300 flex flex-col items-center justify-center gap-2 hover:-translate-y-1">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Scan
                            </button>
                        </div>

                        <!-- BIB Search Content -->
                        <div x-show="tab === 'bib'" x-transition.opacity class="flex flex-col md:flex-row gap-6 items-center relative z-10" style="display: none;">
                            <div class="flex-1 w-full relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none transition-colors duration-300 group-focus-within:text-brand-navy">
                                    <svg class="w-6 h-6 text-brand-muted group-focus-within:text-brand-teal transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" class="block w-full h-20 pl-14 pr-4 bg-brand-light border border-brand-border rounded-2xl text-brand-navy font-bold text-xl focus:ring-2 focus:ring-brand-teal focus:border-brand-teal focus:bg-white focus:outline-none transition-all duration-300 placeholder-brand-muted/70 shadow-sm" placeholder="Ketik Nomor BIB Anda (Contoh: 12044)">
                            </div>
                            <button class="w-full md:w-auto h-20 px-12 bg-brand-navy text-white rounded-2xl font-black text-lg hover:bg-[#152A50] shadow-lg shadow-brand-navy/20 transition-all duration-300 hover:-translate-y-1 flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Cari Foto
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 2. Katalog Foto Event -->
                <div>
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <h3 class="text-2xl font-black text-brand-navy tracking-tight">Katalog Foto</h3>
                            <p class="text-brand-muted text-sm mt-1">Semua foto jepretan fotografer dari event {{ $event->name }}</p>
                        </div>
                    </div>

                    <!-- Masonry-style Grid Container -->
                    <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
                        @forelse($event->photos as $photo)
                        <!-- Photo Item -->
                        <div class="break-inside-avoid group relative rounded-2xl overflow-hidden cursor-pointer bg-gray-100 border border-brand-border shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <img src="{{ asset('storage/' . $photo->watermark_path) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=600'" class="w-full h-auto object-cover" alt="Run Photo">
                            
                            <!-- Overlay Info -->
                            <div class="absolute inset-0 bg-brand-navy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-4">
                                <div class="flex justify-between items-start">
                                    <span class="bg-white/90 text-brand-navy text-[10px] font-black px-2 py-1 rounded shadow-sm flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                        {{ substr($photo->fotografer->name ?? 'Fotografer', 0, 15) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="flex-1 bg-white text-brand-navy font-bold py-2 rounded-lg text-sm hover:bg-brand-teal hover:text-white transition-colors flex justify-center items-center gap-2 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Rp {{ number_format($photo->price, 0, ',', '.') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="w-full break-inside-avoid col-span-full">
                            <div class="text-center py-16 bg-white border border-brand-border rounded-2xl shadow-sm">
                                <svg class="w-16 h-16 text-brand-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-xl font-black text-brand-navy mb-2">Belum Ada Foto di Event Ini</p>
                                <p class="text-brand-muted mb-6">Fotografer sedang memproses dan mengunggah foto. Silakan kembali lagi nanti.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
