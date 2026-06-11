<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian - RunSnap</title>
    
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
                        Cari Acara
                    </a>
                    <a href="/runner/gallery" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Galeri Foto Saya
                    </a>
                    <a href="/runner/transactions" class="flex items-center px-4 py-3 rounded-xl bg-brand-light text-brand-teal font-bold transition-all border border-brand-border shadow-sm">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Riwayat Pembelian
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto relative bg-brand-light">
            <!-- Header -->
            <header class="h-20 shrink-0 bg-white/70 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-40 w-full">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-brand-navy hover:text-brand-teal lg:hidden mr-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-lg font-black text-brand-navy hidden sm:block">Transaksi</h2>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-5">
                    
                    @php $cartCount = count(session('cart', [])); @endphp
                    <!-- Cart/Purchases -->
                    <a href="/runner/cart" class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center bg-brand-orange text-white text-[10px] font-bold rounded-full border-2 border-white shadow-sm">{{ $cartCount }}</span>
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
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">Keluar</button>
                            </form>
                            @else
                            <a href="/login" class="block px-4 py-2 text-sm text-brand-navy hover:bg-brand-light font-bold">Masuk</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-10 w-full max-w-7xl mx-auto flex-1 relative z-10">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-brand-navy tracking-tight">Riwayat Pembelian</h1>
                    <p class="text-brand-muted font-medium mt-1">Daftar transaksi dan invoice pembelian foto Anda.</p>
                </div>

                <!-- Transactions Table Card -->
                <div class="bg-white border border-brand-border rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-brand-light border-b border-brand-border text-brand-muted text-xs uppercase tracking-wider font-bold">
                                    <th class="p-5">ID Penjualan</th>
                                    <th class="p-5">Tanggal</th>
                                    <th class="p-5">Total Bayar</th>
                                    <th class="p-5">Status</th>
                                    <th class="p-5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-brand-border">
                                @forelse($transactions as $trx)
                                <tr class="hover:bg-brand-light/50 transition-colors group">
                                    <td class="p-5">
                                        <div class="font-bold text-brand-navy">{{ $trx->external_id ?? 'INV-XXXX' }}</div>
                                        <div class="text-xs text-brand-muted mt-0.5">{{ $trx->purchasedPhotos->count() ?? 0 }} Item (Foto Lari)</div>
                                    </td>
                                    <td class="p-5 font-medium text-brand-body">{{ \Carbon\Carbon::parse($trx->created_at)->translatedFormat('d M Y') }}</td>
                                    <td class="p-5 font-black text-brand-navy">Rp {{ number_format($trx->total_price ?? 0, 0, ',', '.') }}</td>
                                    <td class="p-5">
                                        @if($trx->status === 'completed')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Berhasil
                                        </span>
                                        @elseif($trx->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-yellow-100 text-yellow-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span> Menunggu Pembayaran
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-red-100 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span> Kedaluwarsa/Gagal
                                        </span>
                                        @endif
                                    </td>
                                    <td class="p-5 text-right">
                                        @if($trx->status === 'completed')
                                        <a href="{{ route('runner.gallery') }}" class="text-brand-teal font-bold text-sm hover:underline">Lihat Galeri</a>
                                        @elseif($trx->status === 'pending')
                                        <a href="{{ route('runner.transactions.pay', $trx->id) }}" class="inline-block bg-brand-navy text-white px-4 py-2 rounded-lg font-bold text-xs hover:bg-[#152A50] transition-colors text-center shadow-sm">Bayar Sekarang</a>
                                        @else
                                        <button class="text-brand-muted font-bold text-sm hover:text-brand-navy transition-colors">Hapus</button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-brand-muted font-medium">Belum ada transaksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="p-4 border-t border-brand-border bg-white flex items-center justify-between">
                        {{ $transactions->links() }}
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
