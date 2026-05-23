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
            <header class="h-20 shrink-0 bg-white/80 backdrop-blur-md border-b border-brand-border flex items-center justify-between px-6 sticky top-0 z-10">
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
                    <div class="relative group pb-4 -mb-4 mr-2">
                        <button class="relative p-2 text-brand-muted hover:text-brand-teal transition-colors focus:outline-none cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-brand-orange rounded-full border-2 border-white"></span>
                        </button>
                    
                        <div class="absolute right-0 top-full mt-1 w-80 bg-white rounded-xl shadow-lg border border-brand-border z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 overflow-hidden">
                            <div class="p-4 border-b border-brand-border flex justify-between items-center bg-brand-light">
                                <h3 class="font-bold text-brand-navy text-sm">Notifikasi</h3>
                                <button class="text-xs text-brand-teal font-bold hover:underline">Tandai dibaca</button>
                            </div>
                            
                            <div class="max-h-80 overflow-y-auto">
                                <a href="{{ route('fotografer.earnings') }}" class="block p-4 border-b border-brand-border hover:bg-brand-light transition-colors bg-white">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-brand-teal/10 text-brand-teal flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-sm text-brand-navy font-bold">Foto Berhasil Terjual! 🎉</p>
                                            <p class="text-xs text-brand-muted mt-1 leading-relaxed">Foto unggahanmu di salah satu event telah dibeli oleh pelari.</p>
                                            <p class="text-[10px] text-brand-teal mt-2 font-bold">Baru saja</p>
                                        </div>
                                    </div>
                                </a>
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
                            <a href="#" class="block w-full text-center p-3 text-xs font-bold text-brand-navy bg-brand-light hover:text-brand-teal transition-colors border-t border-brand-border">Lihat Semua Notifikasi</a>
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

            <!-- Dashboard Content -> Upload -->
            <div class="p-6 sm:p-10 w-full max-w-5xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-brand-navy tracking-tight">Upload Foto Event</h1>
                    <p class="text-brand-muted font-medium mt-1">Unggah hasil jepretan Anda ke event yang tersedia untuk mulai menjual.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-brand-border p-6 sm:p-8">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-brand-navy mb-2">Pilih Event</label>
                            <select name="event_id" class="w-full bg-brand-light border border-brand-border text-brand-navy text-sm rounded-xl focus:ring-brand-teal focus:border-brand-teal block p-3.5 outline-none transition-all cursor-pointer font-medium" required>
                                <option value="" disabled selected>-- Pilih Event Lari --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }} - {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs text-brand-muted mt-2">Pastikan Anda memilih event yang tepat agar pelari bisa menemukan fotonya.</p>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-brand-navy mb-2">Harga Per Foto (Rp)</label>
                            <input type="number" name="price" value="25000" class="w-full bg-brand-light border border-brand-border text-brand-navy text-sm rounded-xl focus:ring-brand-teal focus:border-brand-teal block p-3.5 outline-none transition-all font-bold" required min="10000" step="5000">
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-brand-navy mb-2">Pilih Foto (Drag & Drop)</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-brand-border border-dashed rounded-2xl cursor-pointer bg-brand-light/50 hover:bg-brand-light transition-colors group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
                                            <svg class="w-8 h-8 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        </div>
                                        <p class="mb-2 text-sm text-brand-navy font-bold"><span class="text-brand-teal">Klik untuk memilih file</span> atau drag and drop kesini</p>
                                        <p class="text-xs text-brand-muted">PNG, JPG or JPEG (MAX. 10MB per foto)</p>
                                        <p class="text-xs text-brand-orange font-bold mt-2 bg-brand-orange/10 px-3 py-1 rounded-full">Sistem akan memproses AI & Watermark otomatis!</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="photos[]" multiple class="hidden" accept="image/png, image/jpeg, image/jpg" required />
                                </label>
                            </div> 
                        </div>

                        <div class="flex justify-end pt-4 border-t border-brand-border">
                            <button type="button" class="px-6 py-3 mr-3 text-sm font-bold text-brand-muted bg-brand-light rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                            <button type="submit" class="px-8 py-3 text-sm font-bold text-white bg-brand-teal rounded-xl hover:bg-brand-tealHover shadow-lg shadow-brand-teal/30 transition-all flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Mulai Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>