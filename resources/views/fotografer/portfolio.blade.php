<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Fotografer - RunSnap</title>
    
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
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-brand-light text-brand-body font-sans antialiased" x-data="{ sidebarOpen: false, profileDropdown: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-brand-navy transition duration-300 transform lg:relative lg:translate-x-0 overflow-y-auto flex flex-col justify-between">
            <div>
                <!-- Brand -->
                <div class="flex items-center justify-center h-20 border-b border-[#152A50]">
                    <a href="/" class="text-2xl font-black text-white tracking-tighter flex items-center gap-1 group">
                        <svg class="w-7 h-7 text-brand-teal transform group-hover:-rotate-12 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Run<span class="text-brand-teal">Snap</span>
                    </a>
                </div>

                <!-- Nav Menu -->
                <nav class="mt-6 px-4 space-y-2">
                    <a href="{{ route('fotografer.dashboard') }}" 
                        class="flex items-center px-4 py-3 rounded-xl transition-all font-semibold {{ request()->routeIs('fotografer.dashboard') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-brand-muted hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Halaman Fotografer
                    </a>

                    <a href="{{ route('fotografer.upload') }}" 
                        class="flex items-center px-4 py-3 rounded-xl transition-all font-semibold {{ request()->routeIs('fotografer.upload') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-brand-muted hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Unggah Foto
                    </a>
                
                    <a href="{{ route('fotografer.portfolio') }}" 
                        class="flex items-center px-4 py-3 rounded-xl transition-all font-semibold {{ request()->routeIs('fotografer.portfolio') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-brand-muted hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Portofolio
                    </a>
                
                    <a href="{{ route('fotografer.earnings') }}" 
                        class="flex items-center px-4 py-3 rounded-xl transition-all font-semibold {{ request()->routeIs('fotografer.earnings') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-brand-muted hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pendapatan
                    </a>
                </nav>
            </div>
            
            <!-- Bottom Sidebar (Help / Settings) -->
            <div class="px-4 pb-6 mt-10">
                <div class="bg-gradient-to-tr from-brand-teal/20 to-transparent p-4 rounded-xl border border-brand-teal/10 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-16 h-16 bg-brand-teal/30 rounded-full blur-xl"></div>
                    <h4 class="text-white text-sm font-bold mb-1">Tips Fotografer!</h4>
                    <p class="text-brand-muted text-xs mb-3">Unggah foto maks 1 jam setelah acara untuk penjualan maksimal.</p>
                    <a href="#" class="text-brand-teal text-xs font-bold hover:underline relative z-10 flex items-center">
                        Baca Panduan <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="h-20 shrink-0 bg-white/80 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-10">
                <div class="flex items-center flex-1">
                    <button @click="sidebarOpen = true" class="text-brand-navy hover:text-brand-teal lg:hidden mr-4 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Right Header Items -->
                <div class="flex items-center space-x-4">
                    <!-- Notification -->
                    @php
                        $navMyPhotoIds = \App\Models\Photo::where('fotografer_id', auth()->id())->pluck('id');
                        $navRecentSales = \App\Models\PurchasedPhoto::whereIn('photo_id', $navMyPhotoIds)
                            ->whereHas('transaction', function($q) {
                                $q->where('status', 'completed');
                            })
                            ->with('photo.event')
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
                    @endphp
                    <div class="relative group pb-4 -mb-4 mr-2" x-data="{ 
                            readCount: localStorage.getItem('fg_notif_count_{{ auth()->id() }}') || 0,
                            currentCount: {{ $navRecentSales->count() }},
                            get hasUnread() { return this.currentCount > 0 && this.currentCount != this.readCount; },
                            markRead() { this.readCount = this.currentCount; localStorage.setItem('fg_notif_count_{{ auth()->id() }}', this.currentCount); }
                        }">
                        <button class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors focus:outline-none cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span x-show="hasUnread" style="display: none;" class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white"></span>
                        </button>
                    
                        <div class="absolute right-0 top-full mt-1 w-80 bg-white rounded-xl shadow-lg border border-brand-border z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 overflow-hidden">
                            <div class="p-4 border-b border-brand-border flex justify-between items-center bg-brand-light">
                                <h3 class="font-bold text-brand-navy text-sm">Notifikasi</h3>
                                <button @click="markRead()" class="text-xs text-brand-teal font-bold hover:underline">Tandai dibaca</button>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                @forelse($navRecentSales as $navSale)
                                <a href="{{ route('fotografer.earnings') }}" class="block p-4 border-b border-brand-border hover:bg-brand-light transition-colors bg-white">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-brand-teal/10 text-brand-teal flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-sm text-brand-navy font-bold">Foto Berhasil Terjual! 🎉</p>
                                            <p class="text-xs text-brand-muted mt-1 leading-relaxed">Foto unggahanmu di acara {{ $navSale->photo->event->name ?? 'lari' }} telah dibeli.</p>
                                            <p class="text-[10px] text-brand-teal mt-2 font-bold">{{ $navSale->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                @endforelse
                                <a href="#" class="block p-4 hover:bg-brand-light transition-colors bg-gray-50 opacity-70">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-brand-navy/10 text-brand-navy flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-sm text-brand-navy font-bold">Akun Telah Aktif</p>
                                            <p class="text-xs text-brand-muted mt-1 leading-relaxed">Selamat datang di RunSnap! Mulai unggah karyamu sekarang.</p>
                                            <p class="text-[10px] text-brand-muted mt-2 font-bold">2 hari yang lalu</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Removed Lihat Semua Notifikasi -->
                        </div>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="relative group pb-4 -mb-4">
                        <button class="flex items-center space-x-2 sm:space-x-3 focus:outline-none bg-brand-light p-1.5 pr-3 sm:pr-4 rounded-full border border-brand-border hover:border-brand-teal transition-colors shadow-sm cursor-pointer">
                            <div class="w-8 h-8 bg-brand-navy rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ substr(auth()->user()->name ?? 'F O', 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-brand-navy hidden sm:block">{{ auth()->user()->name ?? 'Fotografer' }}</span>

                            <svg class="w-4 h-4 text-brand-muted hidden sm:block transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg border border-brand-border py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100">
                        <a href="{{ route('fotografer.profile') }}" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Profil Saya</a>
                        <a href="{{ route('fotografer.settings') }}" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Pengaturan Akun</a>
                        <div class="border-t border-brand-border my-1"></div>
                        @auth
                        <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">Keluar</button>
                        </form>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -> Portfolio -->
            <div class="p-6 sm:p-10 w-full max-w-7xl mx-auto" x-data="{ previewPhoto: null }">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-brand-navy tracking-tight">Portofolio Foto</h1>
                        <p class="text-brand-muted font-medium mt-1">Koleksi seluruh foto yang telah Anda unggah, diurutkan berdasarkan acara.</p>
                    </div>
                    <a href="{{ route('fotografer.upload') }}" class="bg-brand-teal text-white hover:bg-brand-tealHover px-5 py-2.5 rounded-xl font-bold transition-all text-sm shadow-[0_4px_14px_0_rgba(0,194,184,0.39)] flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Unggah Foto Baru
                    </a>
                </div>

                @forelse($photosByEvent as $eventId => $photos)
                <div class="bg-white rounded-2xl shadow-sm border border-brand-border mb-8 overflow-hidden">
                    <div class="p-6 border-b border-brand-border bg-brand-light/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-gray-200 overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . ($photos->first()->event->banner_image ?? '')) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=200'" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center flex-wrap gap-2">
                                    <h2 class="text-xl font-black text-brand-navy">{{ $photos->first()->event->name ?? 'Event Tidak Diketahui' }}</h2>
                                    @php $event = $photos->first()->event; @endphp
                                    @if($event)
                                        @if($event->is_published === 'true')
                                            <span class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded font-bold uppercase tracking-wider">Disetujui</span>
                                        @elseif($event->rejection_reason)
                                            <span class="text-[10px] bg-red-100 text-red-700 px-2 py-0.5 rounded font-bold uppercase tracking-wider">Ditolak</span>
                                        @else
                                            <span class="text-[10px] bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded font-bold uppercase tracking-wider">Menunggu Verifikasi</span>
                                        @endif
                                    @endif
                                </div>
                                <p class="text-sm font-medium text-brand-muted mt-0.5 flex items-center flex-wrap gap-2">
                                    <span><svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ \Carbon\Carbon::parse($photos->first()->event->tanggal ?? now())->translatedFormat('d F Y') }}</span>
                                    <span class="text-brand-border">|</span>
                                    <span class="text-brand-teal font-bold">{{ $photos->count() }} Foto Diunggah</span>
                                </p>

                                @if($event && $event->is_published === 'false' && $event->rejection_reason)
                                <div class="mt-3 bg-red-50 border border-red-200 text-red-700 text-xs p-3 rounded-xl flex items-start gap-2 shadow-sm max-w-xl">
                                    <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div>
                                        <p class="font-black mb-0.5">Event Ditolak Admin</p>
                                        <p class="text-red-600 leading-relaxed">{{ $event->rejection_reason }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('fotografer.events.show', $photos->first()->event_id) }}" class="px-4 py-2 text-sm font-bold text-brand-navy bg-white border border-brand-border rounded-lg hover:border-brand-teal transition-colors">Lihat Detail Acara</a>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            @foreach($photos->take(10) as $photo)
                            <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden relative group">
                                <img src="{{ asset('storage/' . $photo->original_path) }}" 
                                    onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=400'" 
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-brand-navy/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                    <button @click="previewPhoto = '{{ asset('storage/' . $photo->original_path) }}'" class="w-8 h-8 bg-white text-brand-navy rounded-full flex items-center justify-center hover:bg-brand-teal hover:text-white transition-colors" title="Lihat Foto">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <form method="POST" action="{{ route('fotografer.photos.delete', $photo->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors" title="Hapus Foto">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                @if($photo->is_processed_ai)
                                <div class="absolute top-2 right-2 bg-brand-teal text-white text-[9px] font-black px-1.5 py-0.5 rounded flex items-center gap-1 shadow-sm">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    AI Siap
                                </div>
                                @endif
                            </div>
                            @endforeach

                            @if($photos->count() > 10)
                            <a href="{{ route('fotografer.events.show', $photos->first()->event_id) }}" class="aspect-square bg-brand-light rounded-xl flex flex-col items-center justify-center border-2 border-brand-border border-dashed hover:border-brand-teal hover:bg-brand-teal/5 transition-colors cursor-pointer group">
                                <span class="text-xl font-black text-brand-navy group-hover:text-brand-teal transition-colors">+{{ $photos->count() - 10 }}</span>
                                <span class="text-xs font-bold text-brand-muted mt-1 group-hover:text-brand-teal transition-colors">Lihat Semua</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-brand-border border-dashed">
                    <div class="w-20 h-20 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-5 text-brand-muted">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-brand-navy">Portofolio Masih Kosong</h3>
                    <p class="text-brand-muted font-medium mt-2 max-w-md mx-auto mb-6">Anda belum pernah mengunggah foto satupun ke platform RunSnap. Mulai unggah foto acara pertama Anda!</p>
                    <a href="{{ route('fotografer.upload') }}" class="inline-flex bg-brand-teal text-white hover:bg-brand-tealHover px-6 py-3 rounded-xl font-bold transition-all shadow-[0_4px_14px_0_rgba(0,194,184,0.39)] items-center justify-center gap-2">
                        Unggah Foto Sekarang
                    </a>
                </div>
                @endforelse

                <!-- Modal Preview -->
                <div x-show="previewPhoto" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4" x-transition.opacity>
                    <div @click.away="previewPhoto = null" class="relative max-w-5xl w-full">
                        <button @click="previewPhoto = null" class="absolute -top-12 right-0 text-white hover:text-brand-teal transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <img :src="previewPhoto" class="w-full h-auto max-h-[85vh] object-contain rounded-xl shadow-2xl">
                    </div>
                </div>

            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                        @if(session('success'))
                                        <script>    
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: '{{ session('success') }}',
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        </script>
                                        @endif

                                        @if(session('error'))
                                        <script>
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                text: '{{ session('error') }}',
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        </script>
                                        @endif

</body>
</html>