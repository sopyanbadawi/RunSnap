<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Fotografer - RunSnap</title>
    
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
                        Dashboard
                    </a>

                    <a href="{{ route('fotografer.upload') }}" 
                        class="flex items-center px-4 py-3 rounded-xl transition-all font-semibold {{ request()->routeIs('fotografer.upload') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-brand-muted hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Upload Foto
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
                    <p class="text-brand-muted text-xs mb-3">Upload foto max 1 jam setelah event untuk penjualan maksimal.</p>
                    <a href="#" class="text-brand-teal text-xs font-bold hover:underline relative z-10 flex items-center">
                        Baca Panduan <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-brand-navy hover:text-brand-teal lg:hidden mr-4 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Right Header Items -->
                <div class="flex items-center space-x-4">
                    <!-- Notification -->
                    <button class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white"></span>
                    </button>

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

            <!-- Dashboard Content -> Earnings -->
            <div class="p-6 sm:p-10 w-full max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-brand-navy tracking-tight">Riwayat Pendapatan</h1>
                        <p class="text-brand-muted font-medium mt-1">Lacak setiap transaksi penjualan foto Anda secara real-time.</p>
                    </div>
                    <div class="bg-white px-5 py-3 rounded-2xl border border-brand-border shadow-sm flex items-center gap-4">
                        <div class="w-10 h-10 bg-brand-teal/10 text-brand-teal rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-brand-muted font-bold uppercase tracking-wider">Total Pendapatan</p>
                            <p class="text-xl font-black text-brand-navy">Rp {{ number_format($totalEarnings ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <button class="ml-4 bg-brand-navy text-white text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-brand-teal transition-colors">Tarik Dana</button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-brand-border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-brand-light/50 border-b border-brand-border">
                                    <th class="py-4 px-6 font-bold text-sm text-brand-navy uppercase tracking-wider">Foto Terjual</th>
                                    <th class="py-4 px-6 font-bold text-sm text-brand-navy uppercase tracking-wider">Event</th>
                                    <th class="py-4 px-6 font-bold text-sm text-brand-navy uppercase tracking-wider">Pembeli</th>
                                    <th class="py-4 px-6 font-bold text-sm text-brand-navy uppercase tracking-wider">Tanggal</th>
                                    <th class="py-4 px-6 font-bold text-sm text-brand-navy uppercase tracking-wider text-right">Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-brand-border">
                                @forelse($purchases as $purchase)
                                <tr class="hover:bg-brand-light/30 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                                <img src="{{ asset('storage/' . ($purchase->photo->watermark_path ?? '')) }}" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=100'" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-brand-navy text-sm">#{{ $purchase->photo_id ?? '---' }}</p>
                                                <p class="text-xs text-brand-teal font-semibold mt-0.5">Sukses</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-semibold text-brand-body text-sm">{{ $purchase->photo->event->name ?? 'Unknown Event' }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-brand-navy text-white flex items-center justify-center text-[10px] font-bold">
                                                {{ substr($purchase->user->name ?? 'P', 0, 1) }}
                                            </div>
                                            <p class="font-semibold text-brand-body text-sm">{{ $purchase->user->name ?? 'Pelari' }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-semibold text-brand-body text-sm">{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y, H:i') }}</p>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <p class="font-black text-brand-navy text-base">+ Rp {{ number_format($purchase->photo->price ?? 25000, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-12 px-6 text-center">
                                        <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-4 text-brand-muted">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-brand-navy">Belum Ada Transaksi</h3>
                                        <p class="text-brand-muted text-sm mt-2 max-w-sm mx-auto">Foto Anda belum ada yang terjual. Terus unggah foto berkualitas di setiap event lari!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($purchases->hasPages())
                    <div class="p-4 border-t border-brand-border">
                        {{ $purchases->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

</body>
</html>