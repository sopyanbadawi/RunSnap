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
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl bg-brand-teal text-white shadow-lg shadow-brand-teal/20 transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-white/5 hover:text-white transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Event Saya
                    </a>

                    <a href="#" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-white/5 hover:text-white transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Manajemen Foto
                    </a>

                    <a href="#" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-white/5 hover:text-white transition-all font-semibold">
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
                    <!-- Search Bar -->
                    <div class="hidden sm:flex items-center bg-brand-light px-4 py-2.5 rounded-full border border-brand-border focus-within:border-brand-teal focus-within:ring-2 focus-within:ring-brand-teal/20 transition-all w-80">
                        <svg class="w-5 h-5 text-brand-muted mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Cari event, nomor bib..." class="bg-transparent border-none focus:outline-none w-full text-sm font-medium text-brand-body placeholder-brand-muted">
                    </div>
                </div>

                <!-- Right Header Items -->
                <div class="flex items-center space-x-4">
                    <!-- Notification -->
                    <button class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white"></span>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="relative" @click.away="profileDropdown = false">
                        <button @click="profileDropdown = !profileDropdown" class="flex items-center space-x-3 focus:outline-none bg-brand-light p-1.5 pr-4 rounded-full border border-brand-border hover:border-brand-teal transition-colors">
                            <div class="w-8 h-8 bg-brand-navy rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ substr(auth()->user()->name ?? 'F O', 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-brand-navy hidden sm:block">{{ auth()->user()->name ?? 'Fotografer' }}</span>
                            <svg class="w-4 h-4 text-brand-muted hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileDropdown" x-transition.enter="transition ease-out duration-100" x-transition.enter-start="transform opacity-0 scale-95" x-transition.enter-end="transform opacity-100 scale-100" x-transition.leave="transition ease-in duration-75" x-transition.leave-start="transform opacity-100 scale-100" x-transition.leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-brand-border py-2 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Profil Saya</a>
                            <a href="#" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Pengaturan Akun</a>
                            <div class="border-t border-brand-border my-1"></div>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6 sm:p-10 w-full max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-brand-navy tracking-tight">Overview</h1>
                        <p class="text-brand-muted font-medium mt-1">Pantau performa dan pendapatan foto Anda hari ini.</p>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <button class="flex-1 md:flex-none bg-white border border-brand-border text-brand-navy hover:text-brand-teal hover:border-brand-teal px-5 py-2.5 rounded-xl font-bold transition-all text-sm shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Cari Event
                        </button>
                        <button class="flex-1 md:flex-none bg-brand-teal text-white hover:bg-brand-tealHover px-5 py-2.5 rounded-xl font-bold transition-all text-sm shadow-[0_4px_14px_0_rgba(0,194,184,0.39)] flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Upload Foto
                        </button>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Stat 1 -->
                    <div class="bg-white rounded-2xl p-6 border border-brand-border shadow-sm relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-24 h-24 bg-brand-teal/5 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-brand-teal/10 text-brand-teal rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-brand-muted font-semibold">Total Pendapatan</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-brand-navy">Rp 0</h3>
                            <p class="text-sm font-medium text-green-500 flex items-center mt-2 group-hover:translate-x-1 transition-transform">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                0% dari bulan lalu
                            </p>
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="bg-white rounded-2xl p-6 border border-brand-border shadow-sm relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-24 h-24 bg-brand-orange/5 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-brand-orange/10 text-brand-orange rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-brand-muted font-semibold">Foto Terjual</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-brand-navy">0</h3>
                            <p class="text-sm font-medium text-brand-muted flex items-center mt-2 group-hover:translate-x-1 transition-transform">
                                <span class="bg-brand-light px-2 py-0.5 rounded text-xs mr-2">0 Foto Diupload</span>
                            </p>
                        </div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="bg-white rounded-2xl p-6 border border-brand-border shadow-sm relative overflow-hidden group">
                        <div class="absolute right-0 top-0 w-24 h-24 bg-brand-navy/5 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-brand-navy/10 text-brand-navy rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-brand-muted font-semibold">Event Didaftarkan</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-brand-navy">0</h3>
                            <p class="text-sm font-medium text-brand-teal flex items-center mt-2 group-hover:translate-x-1 transition-transform hover:underline cursor-pointer">
                                Lihat Semua Event &rarr;
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Recent Events to Upload -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl border border-brand-border shadow-sm p-6 mb-8">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-brand-navy tracking-tight">Event Anda Selanjutnya</h2>
                                <a href="#" class="text-sm font-bold text-brand-teal hover:underline">Kelola Event</a>
                            </div>

                            <!-- Empty State for Event -->
                            <div class="text-center py-12 border-2 border-dashed border-brand-border rounded-xl">
                                <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-4 text-brand-muted">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-brand-navy">Belum Ada Event Aktif</h3>
                                <p class="text-brand-muted text-sm mt-2 max-w-sm mx-auto">Cari event marathon/lari terdekat untuk meliput dan memfoto peserta lari.</p>
                                <button class="mt-6 bg-brand-light border border-brand-border text-brand-navy hover:text-brand-teal hover:border-brand-teal px-6 py-2 rounded-xl font-bold transition-all text-sm">Cari Event Lari</button>
                            </div>
                            
                            <!-- Future Implementation (Sample Row): 
                            <div class="border border-brand-border rounded-xl p-4 flex items-center justify-between hover:border-brand-teal transition-colors group cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-brand-light rounded-lg flex flex-col items-center justify-center border border-brand-border">
                                        <span class="text-xs text-brand-orange font-bold uppercase">Mei</span>
                                        <span class="text-lg font-black text-brand-navy">24</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-brand-navy group-hover:text-brand-teal transition-colors">Jakarta Marathon 2026</h4>
                                        <p class="text-xs text-brand-muted mt-1 flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            GBK, Jakarta Pusat
                                        </p>
                                    </div>
                                </div>
                                <button class="bg-brand-teal/10 text-brand-teal px-4 py-2 rounded-lg font-bold text-sm hover:bg-brand-teal hover:text-white transition-colors">Upload Foto</button>
                            </div>
                            -->
                        </div>
                    </div>

                    <!-- Right Column: Recent Sales -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl border border-brand-border shadow-sm p-6 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-b from-brand-light/50 to-transparent pointer-events-none"></div>
                            
                            <div class="flex justify-between items-center mb-6 relative z-10">
                                <h2 class="text-xl font-bold text-brand-navy tracking-tight">Penjualan Terbaru</h2>
                            </div>

                            <!-- Empty State for Sales -->
                            <div class="text-center py-10 relative z-10">
                                <div class="inline-block p-4 rounded-full bg-brand-light text-brand-muted mb-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <h3 class="text-sm font-bold text-brand-navy">Belum ada penjualan</h3>
                                <p class="text-xs text-brand-muted mt-1">Upload foto Anda ke event untuk mulai mendapatkan penghasilan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>