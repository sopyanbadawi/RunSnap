<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunSnap - Temukan Momen Larimu dalam Hitungan Detik</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="RunSnap adalah platform distribusi dan monetisasi foto event lari berbasis AI. Hubungkan fotografer dan pelari secara instan.">
    <meta name="keywords" content="RunSnap, Foto Lari, Marathon, AI Face Recognition, Fotografer Olahraga">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN for quick setup, replace with Vite build in production) -->
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
                            tealPressed: '#009B93',
                            orange: '#FF6A3D',
                            orangeHover: '#FF5A2A',
                            light: '#F6F8FB',
                            border: '#E6ECF2',
                            body: '#334155',
                            muted: '#64748B'
                        }
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- AOS Animation Library (Alternative for Framer Motion in Vanilla HTML) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #0B1B3A 0%, #00C2B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .clip-path-slant {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
    </style>
</head>
<body class="bg-brand-light text-brand-body font-sans antialiased overflow-x-hidden selection:bg-brand-teal selection:text-white">

    <!-- 1. Navbar -->
    <nav class="fixed w-full z-50 glass-nav border-b border-brand-border transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-3xl font-black text-brand-navy tracking-tighter flex items-center gap-1 group">
                        <svg class="w-8 h-8 text-brand-teal transform group-hover:-rotate-12 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Run<span class="text-brand-teal">Snap</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-10 items-center font-semibold text-sm">
                    <a href="#beranda" class="text-brand-navy hover:text-brand-teal transition-colors">Beranda</a>
                    <a href="#tentang" class="text-brand-navy hover:text-brand-teal transition-colors">Tentang Kami</a>
                    <a href="#fitur" class="text-brand-navy hover:text-brand-teal transition-colors">Fitur</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-5">
                    <a href="/runsnap/login" class="text-brand-navy font-bold hover:text-brand-teal transition-colors">Masuk</a>
                    <a href="/register" class="bg-brand-teal text-white px-7 py-2.5 rounded-full font-bold shadow-lg shadow-brand-teal/20 hover:bg-brand-tealHover hover:shadow-brand-teal/30 transition-all transform hover:-translate-y-0.5">Daftar</a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-brand-navy hover:text-brand-teal focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden clip-path-slant bg-white">
        <!-- Background decorative elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-brand-teal opacity-10 blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 -ml-20 w-72 h-72 rounded-full bg-brand-orange opacity-10 blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center cursor-default">
                
                <!-- Left: Animation -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-start mb-12 lg:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <div class="relative w-full max-w-md aspect-square mt-10">
                        <!-- Abstract glow behind animation -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-brand-navy/10 to-brand-teal/20 rounded-full blur-2xl transform scale-90"></div>
                        
                        <!-- Main Hero Image -->
                        <div class="w-full h-full relative z-10 drop-shadow-2xl animate-float flex justify-center items-center">
                            <img src="{{ asset('assets/org_lari.png') }}" alt="Runner Illustration" class="w-full h-full object-contain filter drop-shadow-[0_20px_50px_rgba(0,194,184,0.3)] scale-110 md:scale-125" />
                        </div>

                        <!-- Floating GIF 1 (Camera) -->
                        <div class="absolute top-0 -left-6 md:-left-12 z-20 animate-float" style="animation-delay: 1.5s;">
                            <div class="bg-white/90 backdrop-blur-sm p-4 rounded-3xl shadow-2xl border border-white/50 transform -rotate-6">
                                <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f4f8/512.gif" alt="Camera GIF" class="w-16 h-16 drop-shadow-md" />
                            </div>
                        </div>

                        <!-- Floating GIF 2 (Fire/Speed) -->
                        <div class="absolute bottom-10 -right-4 md:-right-10 z-20 animate-float" style="animation-delay: 0.5s;">
                            <div class="bg-white/90 backdrop-blur-sm px-6 py-3 rounded-2xl shadow-xl border border-white/50 flex items-center gap-3 transform rotate-6">
                                <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f525/512.gif" alt="Fire GIF" class="w-10 h-10 drop-shadow-md" />
                                <span class="font-bold text-brand-navy">Sangat Cepat!</span>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="w-full lg:w-1/2 text-center lg:text-left" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-brand-teal/10 text-brand-teal font-bold text-xs uppercase tracking-wider mb-6 border border-brand-teal/20 shadow-sm">
                        🚀 Platform Nomor 1 Untuk Event Lari
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-black text-brand-navy leading-tight mb-6 tracking-tight">
                        Temukan Momen Larimu<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-navy to-brand-teal">dalam Hitungan Detik!</span>
                    </h1>
                    <p class="text-lg text-brand-muted mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                        RunSnap adalah platform distribusi dan monetisasi foto event lari berbasis <span class="font-bold text-brand-teal">AI Face Recognition</span>. Hubungkan fotografer dan pelari secara instan tanpa perlu scrolling manual ribuan foto.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/login" class="bg-brand-teal text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg shadow-brand-teal/30 hover:bg-brand-tealHover hover:shadow-brand-teal/40 transition-all transform hover:-translate-y-1 flex justify-center items-center gap-2 group">
                            Cari Fotomu Sekarang
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="#fitur" class="bg-white text-brand-navy px-8 py-4 rounded-full font-bold text-lg border-2 border-brand-border hover:border-brand-teal hover:text-brand-teal transition-all flex justify-center items-center">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- 4. Storytelling / Masaah vs Solusi -->
    <section class="py-20 bg-brand-light relative" id="tentang">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl lg:text-4xl font-black text-brand-navy mb-4">Ucapkan Selamat Tinggal pada Cara Lama</h2>
                <p class="text-brand-muted max-w-2xl mx-auto text-lg font-medium">Kami mengubah pengalaman mencari foto lari yang melelahkan menjadi sesuatu yang magis.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                <!-- Cara Lama -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-brand-border opacity-80" data-aos="fade-right">
                    <div class="w-14 h-14 bg-red-100 text-red-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-muted mb-4 line-through">Cara Lama</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-3 text-brand-muted">
                            <span class="text-red-400">✖</span>
                            Scrolling manual ribuan foto di Google Drive
                        </li>
                        <li class="flex gap-3 text-brand-muted">
                            <span class="text-red-400">✖</span>
                            Memakan waktu lebih dari 30 menit
                        </li>
                        <li class="flex gap-3 text-brand-muted">
                            <span class="text-red-400">✖</span>
                            Kualitas foto turun karena screenshot
                        </li>
                        <li class="flex gap-3 text-brand-muted">
                            <span class="text-red-400">✖</span>
                            Pembayaran manual via transfer rumit
                        </li>
                    </ul>
                </div>

                <!-- Cara RunSnap -->
                <div class="bg-gradient-to-br from-brand-navy to-[#0F224A] rounded-3xl p-8 shadow-2xl shadow-brand-navy/20 text-white transform md:-translate-y-4 relative overflow-hidden" data-aos="fade-left">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
                    <div class="w-14 h-14 bg-brand-teal text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-brand-teal/40">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black mb-4">Cara RunSnap</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-3 text-brand-light font-medium">
                            <span class="text-brand-teal">✔</span>
                            Upload 1 selfie, AI temukan semua fotomu
                        </li>
                        <li class="flex gap-3 text-brand-light font-medium">
                            <span class="text-brand-teal">✔</span>
                            Hasil muncul instan dalam hitungan detik
                        </li>
                        <li class="flex gap-3 text-brand-light font-medium">
                            <span class="text-brand-teal">✔</span>
                            Resolusi asli tanpa kompresi setelah bayar
                        </li>
                        <li class="flex gap-3 text-brand-light font-medium">
                            <span class="text-brand-teal">✔</span>
                            Transaksi otomatis QRIS/Virtual Account
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Features Section -->
    <section id="fitur" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-brand-teal font-bold tracking-wider uppercase text-sm">Keunggulan Ekosistem</span>
                <h2 class="text-3xl lg:text-4xl font-black text-brand-navy mt-2 mb-4">Fitur Core RunSnap</h2>
                <div class="w-24 h-1.5 bg-brand-teal mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-brand-light p-8 rounded-3xl hover:shadow-xl hover:bg-white transition-all duration-300 border border-transparent hover:border-brand-border group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-brand-teal/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-brand-teal group-hover:text-white text-brand-teal transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-navy mb-3">AI Face Recognition</h3>
                    <p class="text-brand-muted text-sm leading-relaxed">Pelari cukup unggah satu foto selfie untuk menemukan semua foto mereka di event marathon secara otomatis.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-brand-light p-8 rounded-3xl hover:shadow-xl hover:bg-white transition-all duration-300 border border-transparent hover:border-brand-border group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-brand-orange/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-brand-orange group-hover:text-white text-brand-orange transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-navy mb-3">Batch Upload</h3>
                    <p class="text-brand-muted text-sm leading-relaxed">Memudahkan fotografer mengunggah ribuan foto sekaligus berdasarkan folder event atau kilometer tertentu tanpa macet.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-brand-light p-8 rounded-3xl hover:shadow-xl hover:bg-white transition-all duration-300 border border-transparent hover:border-brand-border group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-brand-navy/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-brand-navy group-hover:text-white text-brand-navy transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-navy mb-3">Auto Payment & Watermark</h3>
                    <p class="text-brand-muted text-sm leading-relaxed">Transaksi instan QRIS/VA. Foto asli tanpa watermark otomatis dikirim dan bisa diunduh pelari seketika setelah bayar.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-brand-light p-8 rounded-3xl hover:shadow-xl hover:bg-white transition-all duration-300 border border-transparent hover:border-brand-border group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-brand-teal/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-brand-teal group-hover:text-white text-brand-teal transition-all duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-brand-navy mb-3">Transparent Dashboard</h3>
                    <p class="text-brand-muted text-sm leading-relaxed">Statistik penjualan real-time, pencairan dana kilat bagi fotografer, dan histori pembelian rapi bagi pelari.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Global CTA -->
    <section class="py-20 relative overflow-hidden bg-brand-navy clip-path-slant" style="clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 100%); margin-top: -5%;">
        <div class="absolute inset-0 bg-brand-teal opacity-20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center pt-16">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6" data-aos="fade-up">Mulai Perjalanan Epikmu</h2>
            <p class="text-xl text-brand-light mb-10 font-medium" data-aos="fade-up" data-aos-delay="100">Bergabunglah sebagai Fotografer atau Pelari, dan rasakan kemudahan menemukan momen terbaik di setiap finish line.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="zoom-in" data-aos-delay="200">
                <a href="/register" class="bg-brand-teal text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-brand-tealHover transition-all transform hover:scale-105 shadow-xl shadow-brand-teal/20">Daftar Sekarang</a>
                <a href="/login" class="bg-transparent text-white border-2 border-white/30 px-10 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-brand-navy transition-all">Sudah Punya Akun?</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0B1B3A] text-brand-muted py-12 border-t border-[#152A50]">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-xl font-black text-white tracking-tight">Run<span class="text-brand-teal">Snap</span></span>
            </div>
            
            <p class="text-sm font-medium text-center md:text-right">
                &copy; 2026 RunSnap<br class="md:hidden" /> <span class="hidden md:inline"> - </span> Jurusan Teknologi Informasi Politeknik Negeri Malang
            </p>
        </div>
    </footer>

    <!-- Animations Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS (Animate on Scroll)
        AOS.init({
            once: true,
            offset: 50,
        });

        // Add scrolled class to navbar for glass effect transition
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-sm');
                nav.classList.replace('border-transparent', 'border-brand-border');
            } else {
                nav.classList.remove('shadow-sm');
                nav.classList.replace('border-brand-border', 'border-transparent');
            }
        });
    </script>
</body>
</html>
