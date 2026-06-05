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
                    <h1 class="text-3xl font-black text-brand-navy tracking-tight">Unggah Foto Acara</h1>
                    <p class="text-brand-muted font-medium mt-1">Unggah hasil jepretan Anda ke acara yang tersedia untuk mulai menjual.</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-bold text-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl font-bold text-sm flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-brand-border p-6 sm:p-8">
                    <form action="{{ route('fotografer.storeUpload') }}" method="POST" enctype="multipart/form-data"
                        x-data="{ 
                            files: [], 
                            isDragging: false,
                            bannerName: '',
                            bannerPreview: '',
                            handleFiles(fileList) {
                                this.files = Array.from(fileList);
                            },
                            handleBanner(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    this.bannerName = file.name;
                                    this.bannerPreview = URL.createObjectURL(file);
                                }
                            }
                        }">
                        @csrf
                        
                        <!-- Bagian 1: Detail Event Baru -->
                        <div class="mb-8 border-b border-brand-border pb-6">
                            <h3 class="text-lg font-bold text-brand-navy mb-4 flex items-center gap-2">
                                <span class="w-7 h-7 bg-brand-teal/10 text-brand-teal rounded-lg flex items-center justify-center text-sm">1</span>
                                Detail Event Baru
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-bold text-brand-navy mb-2">Nama Event <span class="text-brand-orange">*</span></label>
                                    <input type="text" name="name" placeholder="Contoh: Jakarta Marathon 2026" class="w-full bg-brand-light border border-brand-border text-brand-navy text-sm rounded-xl focus:ring-brand-teal focus:border-brand-teal block p-3.5 outline-none transition-all font-medium" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-brand-navy mb-2">Tanggal Pelaksanaan <span class="text-brand-orange">*</span></label>
                                    <input type="date" name="tanggal" class="w-full bg-brand-light border border-brand-border text-brand-navy text-sm rounded-xl focus:ring-brand-teal focus:border-brand-teal block p-3.5 outline-none transition-all font-medium" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-brand-navy mb-2">Lokasi Event</label>
                                    <input type="text" name="lokasi" placeholder="Contoh: GBK, Jakarta Pusat" class="w-full bg-brand-light border border-brand-border text-brand-navy text-sm rounded-xl focus:ring-brand-teal focus:border-brand-teal block p-3.5 outline-none transition-all font-medium">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-brand-navy mb-2">Gambar Banner Event <span class="text-brand-orange">*</span></label>
                                    <label for="banner-image-file" class="flex flex-col items-center justify-center w-full h-[50px] border border-brand-border rounded-xl cursor-pointer hover:bg-brand-light bg-brand-light/50 transition-colors relative overflow-hidden px-4">
                                        <!-- Preview Background -->
                                        <template x-if="bannerPreview">
                                            <div class="absolute inset-0 z-0 bg-cover bg-center opacity-10" :style="'background-image: url(' + bannerPreview + ')'"></div>
                                        </template>
                                        <div class="flex items-center justify-between w-full relative z-10">
                                            <span class="text-xs font-semibold text-brand-muted truncate max-w-[200px]" x-text="bannerName ? bannerName : 'Pilih banner (maks. 5MB)'"></span>
                                            <span class="text-xs font-bold text-brand-teal">Pilih File</span>
                                        </div>
                                        <input id="banner-image-file" type="file" name="banner_image" class="hidden" accept="image/png, image/jpeg, image/jpg" @change="handleBanner($event)" required />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 2: Unggah Foto & Harga -->
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-brand-navy mb-4 flex items-center gap-2">
                                <span class="w-7 h-7 bg-brand-teal/10 text-brand-teal rounded-lg flex items-center justify-center text-sm">2</span>
                                Unggah Foto & Harga
                            </h3>

                            <div class="mb-6">
                                <label class="block text-sm font-bold text-brand-navy mb-2">Harga Per Foto (Rp) <span class="text-brand-orange">*</span></label>
                                <input type="number" name="price" value="25000" class="w-full bg-brand-light border border-brand-border text-brand-navy text-sm rounded-xl focus:ring-brand-teal focus:border-brand-teal block p-3.5 outline-none transition-all font-bold" required min="10000" step="5000">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-brand-navy mb-2">Pilih Foto (Tarik & Lepas) <span class="text-brand-orange">*</span></label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" 
                                        class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed rounded-2xl cursor-pointer transition-colors group relative"
                                        :class="isDragging ? 'border-brand-teal bg-brand-teal/5' : 'border-brand-border bg-brand-light/50 hover:bg-brand-light'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="isDragging = false; handleFiles($event.dataTransfer.files); $refs.fileInput.files = $event.dataTransfer.files">
                                        
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                                <svg class="w-6 h-6 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            </div>
                                            
                                            <template x-if="files.length === 0">
                                                <div>
                                                    <p class="mb-1 text-sm text-brand-navy font-bold"><span class="text-brand-teal">Klik untuk memilih file foto</span> atau tarik & lepas ke sini</p>
                                                    <p class="text-xs text-brand-muted">PNG, JPG or JPEG (MAKS. 10MB per foto, bisa pilih banyak)</p>
                                                </div>
                                            </template>
                                            
                                            <template x-if="files.length > 0">
                                                <div>
                                                    <p class="mb-1 text-sm text-brand-navy font-bold text-brand-teal">
                                                        <span x-text="files.length"></span> File Terpilih
                                                    </p>
                                                    <div class="text-xs text-brand-muted max-w-md truncate bg-white/80 p-2 rounded-lg border border-brand-border mt-1 max-h-20 overflow-y-auto">
                                                        <template x-for="file in files">
                                                            <div x-text="file.name" class="truncate py-0.5"></div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>

                                            <p class="text-xs text-brand-orange font-bold mt-3 bg-brand-orange/10 px-3 py-1 rounded-full">Sistem akan memproses AI & Watermark otomatis setelah admin menyetujui!</p>
                                        </div>
                                        
                                        <input id="dropzone-file" 
                                            x-ref="fileInput"
                                            type="file" 
                                            name="photos[]" 
                                            multiple 
                                            class="hidden" 
                                            accept="image/png, image/jpeg, image/jpg" 
                                            @change="handleFiles($event.target.files)"
                                            required />
                                    </label>
                                </div> 
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-brand-border">
                            <button type="button" @click="files = []; $refs.fileInput.value = ''" class="px-6 py-3 mr-3 text-sm font-bold text-brand-muted bg-brand-light rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                            <button type="submit" class="px-8 py-3 text-sm font-bold text-white bg-brand-teal rounded-xl hover:bg-brand-tealHover shadow-lg shadow-brand-teal/30 transition-all flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Mulai Unggah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>