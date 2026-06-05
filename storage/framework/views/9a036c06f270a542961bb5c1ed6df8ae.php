<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Acara - RunSnap</title>
    
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
                        Cari Acara
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
                                <?php echo e(substr(auth()->user()->name ?? 'R U', 0, 1)); ?>

                            </div>
                            <span class="text-sm font-bold text-brand-navy hidden sm:block"><?php echo e(auth()->user()->name ?? 'Pelari Runner'); ?></span>
                            <svg class="w-4 h-4 text-brand-muted hidden sm:block transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div class="absolute right-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg border border-brand-border py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100">
                            <a href="/runner/profile" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Profil & Data Diri</a>
                            <a href="/runner/settings" class="block px-4 py-2 text-sm text-brand-body hover:bg-brand-light hover:text-brand-teal font-medium">Pengaturan Akun</a>
                            <div class="border-t border-brand-border my-1"></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <form method="POST" action="<?php echo e(route('filament.admin.auth.logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 font-bold">Keluar</button>
                            </form>
                            <?php else: ?>
                            <a href="/login" class="block px-4 py-2 text-sm text-brand-navy hover:bg-brand-light font-bold">Masuk</a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-10 w-full max-w-7xl mx-auto flex-1 relative z-10">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-brand-navy tracking-tight">Cari Acara Lari</h1>
                        <p class="text-brand-muted font-medium mt-1">Jelajahi ratusan acara marathon dan fun run untuk menemukan fotomu.</p>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 w-full md:w-auto">
                        <select class="bg-white border border-brand-border text-sm font-bold text-brand-navy rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:border-brand-teal">
                            <option>Semua Lokasi</option>
                            <option>Jakarta</option>
                            <option>Bali</option>
                            <option>Jawa Barat</option>
                        </select>
                        <select class="bg-white border border-brand-border text-sm font-bold text-brand-navy rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:border-brand-teal">
                            <option>Kapan Saja</option>
                            <option>Bulan Ini</option>
                            <option>Selesai</option>
                        </select>
                    </div>
                </div>

                <!-- Event Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(route('runner.events.show', $event->id)); ?>" class="group bg-white border border-brand-border rounded-2xl overflow-hidden shadow-sm hover:border-brand-teal hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                        <div class="h-40 bg-gray-200 relative overflow-hidden">
                            <img src="<?php echo e(asset('storage/' . $event->banner_image)); ?>" onerror="this.src='https://images.unsplash.com/photo-1552674605-15c3705922e6?auto=format&fit=crop&q=80&w=600'" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="Event Banner">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-navy/90 via-brand-navy/20 to-transparent"></div>
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-brand-navy text-[10px] font-black px-2.5 py-1 rounded-md shadow-sm">
                                <span class="text-brand-teal mr-1">●</span>Selesai
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h4 class="font-black text-base mb-0.5 leading-tight group-hover:text-brand-teal transition-colors"><?php echo e($event->name); ?></h4>
                                <p class="text-xs text-gray-300 flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    <?php echo e($event->lokasi ?? 'Lokasi Belum Ditentukan'); ?>

                                </p>
                            </div>
                        </div>
                        <div class="p-4 bg-white flex justify-between items-center mt-auto border-t border-brand-border/50">
                            <div>
                                <p class="text-[10px] text-brand-muted font-bold mb-0.5">TANGGAL</p>
                                <p class="text-sm font-bold text-brand-navy"><?php echo e(\Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y')); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-brand-muted font-bold mb-0.5">FOTO</p>
                                <p class="text-sm font-black text-brand-teal"><?php echo e($event->photos->count() ?? 0); ?></p>
                            </div>
                        </div>
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-span-full text-center py-10 bg-white border border-brand-border rounded-2xl shadow-sm">
                        <p class="text-brand-muted font-medium">Belum ada acara lari yang sesuai filter.</p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    <?php echo e($events->links()); ?>

                </div>

            </div>
        </main>
    </div>

</body>
</html>
<?php /**PATH C:\Users\HP\RunSnap\resources\views/runner/events.blade.php ENDPATH**/ ?>