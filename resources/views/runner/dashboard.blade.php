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
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl bg-brand-light text-brand-teal font-bold transition-all border border-brand-border">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda Pelari
                    </a>
                    
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Event
                    </a>

                    <a href="#" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Galeri Foto Saya
                    </a>

                    <a href="#" class="flex items-center px-4 py-3 rounded-xl text-brand-muted hover:bg-brand-light hover:text-brand-navy transition-all font-semibold">
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
                    <p class="text-brand-light/70 text-xs mb-4">Temukan fotomu secara otomatis hanya dengan 1 selfie.</p>
                    <button class="w-full bg-brand-teal text-white text-xs font-bold py-2 rounded-lg hover:bg-brand-tealHover transition-colors flex justify-center items-center gap-1 shadow-[0_4px_14px_0_rgba(0,194,184,0.39)]">
                        Upload Selfie <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto">
            <!-- Header -->
            <header class="h-20 bg-white/70 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-10 w-full">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-brand-navy hover:text-brand-teal lg:hidden mr-4 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Right Header Items -->
                <div class="flex items-center space-x-3 sm:space-x-5">
                    
                    <!-- Search Icon (Mobile Only) -->
                    <button class="sm:hidden text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>

                    <!-- Cart/Purchases -->
                    <button class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white"></span>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="relative" @click.away="profileDropdown = false">
                        <button @click="profileDropdown = !profileDropdown" class="flex items-center space-x-2 sm:space-x-3 focus:outline-none bg-brand-light p-1.5 pr-3 sm:pr-4 rounded-full border border-brand-border hover:border-brand-teal transition-colors">
                            <div class="w-8 h-8 bg-brand-teal/20 text-brand-teal rounded-full flex items-center justify-center font-bold text-sm">
                                {{ substr(auth()->user()->name ?? 'R U', 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-brand-navy hidden sm:block">{{ auth()->user()->name ?? 'Pelari Runner' }}</span>
                            <svg class="w-4 h-4 text-brand-muted hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileDropdown" x-transition.enter="transition ease-out duration-100" x-transition.enter-start="transform opacity-0 scale-95" x-transition.enter-end="transform opacity-100 scale-100" x-transition.leave="transition ease-in duration-75" x-transition.leave-start="transform opacity-100 scale-100" x-transition.leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-brand-border py-2 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Profil & Data Diri</a>
                            <a href="#" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Pengaturan Akun</a>
                            <div class="border-t border-brand-border my-1"></div>
                            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-10 w-full max-w-7xl mx-auto flex-1">
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-brand-navy tracking-tight">Halo, {{ explode(' ', auth()->user()->name ?? 'Pelari')[0] }}! 🏃‍♂️</h1>
                    <p class="text-brand-muted font-medium mt-1">Siap menemukan momen terbaik di race terakhirmu?</p>
                </div>

                <!-- Highlighted / Popular Events -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-brand-navy tracking-tight">Event Sedang Trending</h3>
                        <a href="#" class="text-sm font-bold text-brand-teal hover:underline flex items-center">Lihat Semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                    </div>
                    
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Event Card 1 -->
                        <a href="#" class="group bg-white border border-brand-border rounded-2xl overflow-hidden shadow-sm hover:border-brand-teal hover:shadow-lg transition-all flex flex-col h-full">
                            <div class="h-40 bg-gray-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" alt="Event Banner">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 bg-brand-teal text-white text-xs font-bold px-2 py-1 rounded-md">Baru Berakhir</div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-brand-navy mb-2 group-hover:text-brand-teal transition-colors">Jakarta International Marathon</h4>
                                <p class="text-xs text-brand-muted flex items-center mb-4">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    12 April 2026
                                </p>
                                <div class="flex items-center gap-2">
                                    <div class="flex -space-x-2">
                                        <div class="w-7 h-7 rounded-full border-2 border-white bg-brand-teal text-white flex items-center justify-center text-[10px] font-bold">F</div>
                                        <div class="w-7 h-7 rounded-full border-2 border-white bg-brand-navy text-white flex items-center justify-center text-[10px] font-bold">A</div>
                                    </div>
                                    <span class="text-[11px] text-brand-muted font-semibold">+ 45 Fotografer Meliput</span>
                                </div>
                            </div>
                        </a>

                        <!-- Event Card 2 -->
                        <a href="#" class="group bg-white border border-brand-border rounded-2xl overflow-hidden shadow-sm hover:border-brand-teal hover:shadow-lg transition-all flex flex-col h-full">
                            <div class="h-40 bg-gray-200 relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1530124566582-a618bc2615dc?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" alt="Event Banner">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-brand-navy mb-2 group-hover:text-brand-teal transition-colors">Bali Ultra Trail 2026</h4>
                                <p class="text-xs text-brand-muted flex items-center mb-4">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    5 Mei 2026
                                </p>
                                <div class="flex items-center gap-2">
                                    <div class="flex -space-x-2">
                                        <div class="w-7 h-7 rounded-full border-2 border-white bg-brand-orange text-white flex items-center justify-center text-[10px] font-bold">D</div>
                                    </div>
                                    <span class="text-[11px] text-brand-muted font-semibold">12 Fotografer Bersiap</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Purchases / Foto Terbaru (Empty State) -->
                <div>
                    <h3 class="text-xl font-bold text-brand-navy mb-4">Koleksi Foto Terbarumu</h3>
                    <div class="bg-white rounded-2xl border border-brand-border p-8 text-center shadow-sm">
                        <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-4 text-brand-muted">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-brand-navy">Belum ada foto yang dibuka</h4>
                        <p class="text-brand-muted text-sm mt-1 max-w-sm mx-auto">Upload selfie Anda sekarang untuk mulai mengumpulkan kenangan lari Anda yang menakjubkan.</p>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
