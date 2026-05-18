<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - RunSnap</title>
    
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
    <style>
        .watermark-cart {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-20deg);
            color: rgba(255, 255, 255, 0.7);
            font-weight: 900;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            pointer-events: none;
            text-shadow: 0px 2px 5px rgba(0,0,0,0.5);
        }
    </style>
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
                    <h2 class="text-lg font-black text-brand-navy hidden sm:block">Checkout</h2>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-5">
                    <!-- Cart/Purchases -->
                    <a href="/runner/cart" class="relative p-2 text-brand-teal bg-brand-teal/10 rounded-xl transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center bg-brand-orange text-white text-[10px] font-bold rounded-full border-2 border-white shadow-sm">2</span>
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
            <div class="p-4 sm:p-6 lg:p-10 w-full max-w-6xl mx-auto flex-1 relative z-10">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-brand-navy tracking-tight">Keranjang Anda</h1>
                    <p class="text-brand-muted font-medium mt-1">Anda memiliki {{ $photos->count() }} foto berkualitas tinggi di keranjang.</p>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Left: Item List -->
                    <div class="flex-1 space-y-4">
                        
                        @forelse($photos as $photo)
                        <!-- Cart Item -->
                        <div class="bg-white border border-brand-border rounded-2xl shadow-sm p-4 flex flex-col sm:flex-row gap-5 items-center sm:items-start group transition-all hover:border-brand-teal">
                            <div class="relative w-full sm:w-40 h-28 bg-gray-200 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $photo->watermark_path) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=300'" class="w-full h-full object-cover filter blur-[1px]" alt="Thumbnail">
                                <div class="absolute inset-0 bg-brand-navy/30"></div>
                                <div class="watermark-cart">RUNSNAP</div>
                            </div>
                            <div class="flex-1 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-brand-navy text-lg leading-tight">{{ $photo->event->name ?? 'Event Lari' }}</h3>
                                        <p class="text-xs font-bold text-brand-teal mt-1 flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                            Fotografer: BudiSnap
                                        </p>
                                    </div>
                                    <button class="text-brand-muted hover:text-red-500 transition-colors p-1" title="Hapus foto">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                                <div class="mt-4 flex justify-between items-end border-t border-brand-border/50 pt-3">
                                    <div class="flex gap-2">
                                        <span class="bg-brand-light text-brand-muted text-[10px] font-bold px-2 py-1 rounded">Resolusi Asli</span>
                                        <span class="bg-brand-light text-brand-muted text-[10px] font-bold px-2 py-1 rounded">Tanpa Watermark</span>
                                    </div>
                                    <p class="font-black text-brand-navy text-lg">Rp {{ number_format($photo->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10 bg-white border border-brand-border rounded-2xl shadow-sm">
                            <p class="text-brand-muted font-medium">Keranjang belanja Anda masih kosong.</p>
                            <a href="/runner/events" class="inline-block mt-3 text-brand-teal font-bold hover:underline">Cari Foto Event</a>
                        </div>
                        @endforelse

                    </div>

                    <!-- Right: Order Summary -->
                    <div class="lg:w-96 flex-shrink-0">
                        <div class="bg-white border border-brand-border rounded-2xl shadow-sm p-6 sticky top-24">
                            <h3 class="font-black text-brand-navy text-xl mb-6">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-sm font-medium text-brand-body">
                                    <span>Subtotal ({{ $photos->count() }} Item)</span>
                                    <span class="font-bold text-brand-navy">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm font-medium text-brand-body">
                                    <span class="flex items-center gap-1">Biaya Layanan <svg class="w-3.5 h-3.5 text-brand-muted cursor-help" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                                    <span class="font-bold text-brand-navy">Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <!-- Promo Code -->
                            <div class="mb-6">
                                <div class="flex relative">
                                    <input type="text" class="w-full bg-brand-light border border-brand-border rounded-l-xl px-4 py-2.5 text-sm font-bold text-brand-navy focus:outline-none focus:border-brand-teal uppercase" placeholder="KODE PROMO">
                                    <button class="bg-brand-navy text-white px-4 rounded-r-xl font-bold text-sm hover:bg-[#152A50] transition-colors">Gunakan</button>
                                </div>
                            </div>

                            <div class="border-t border-brand-border pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-brand-navy">Total Pembayaran</span>
                                    <span class="font-black text-brand-teal text-2xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button class="w-full bg-brand-teal text-white font-black py-4 rounded-xl hover:bg-brand-tealHover transition-colors shadow-lg shadow-brand-teal/20 flex justify-center items-center gap-2 group">
                                Lanjut ke Pembayaran
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>

                            <div class="mt-5 text-center flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                <span class="text-xs font-bold text-brand-muted">Transaksi Aman Terenkripsi</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
