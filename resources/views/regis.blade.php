<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - RunSnap</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN for quick setup) -->
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
                        'float': 'float 3s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brand-light font-sans text-brand-body selection:bg-brand-teal selection:text-white min-h-screen flex items-center justify-center p-4 lg:p-8">

    <div class="max-w-6xl w-full bg-white rounded-[2rem] shadow-2xl shadow-brand-navy/5 border border-brand-border overflow-hidden flex flex-col lg:flex-row min-h-[600px] opacity-0 animate-fade-in-up">
        
        <!-- Left Side: Form Container -->
        <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center relative">
            
            <!-- Mobile Logo (Visible only on small screens) -->
            <a href="/" class="inline-flex lg:hidden items-center gap-2 mb-8">
                <svg class="w-8 h-8 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-2xl font-black text-brand-navy tracking-tight">Run<span class="text-brand-teal">Snap</span></span>
            </a>

            <div>
                <h1 class="text-3xl lg:text-4xl font-black text-brand-navy tracking-tight mb-2">Mulai Perjalananmu.</h1>
                <p class="text-brand-muted font-medium mb-8">Bergabunglah dan temukan setiap momen epic larimu dalam hitungan detik.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-brand-navy mb-1.5">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required autofocus
                        class="w-full px-4 py-3.5 rounded-xl border border-brand-border bg-brand-light focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-teal/50 focus:border-brand-teal transition-all text-brand-body text-sm placeholder-brand-muted" 
                        placeholder="John Doe">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-brand-navy mb-1.5">Email Address</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3.5 rounded-xl border border-brand-border bg-brand-light focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-teal/50 focus:border-brand-teal transition-all text-brand-body text-sm placeholder-brand-muted" 
                        placeholder="nama@email.com">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-brand-navy mb-1.5">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3.5 rounded-xl border border-brand-border bg-brand-light focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-teal/50 focus:border-brand-teal transition-all text-brand-body text-sm placeholder-brand-muted" 
                            placeholder="••••••••">
                    </div>
                    
                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-brand-navy mb-1.5">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3.5 rounded-xl border border-brand-border bg-brand-light focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-teal/50 focus:border-brand-teal transition-all text-brand-body text-sm placeholder-brand-muted" 
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Pilih Peran -->
                <div class="pt-2">
                    <label class="block text-sm font-semibold text-brand-navy mb-3">Daftar Sebagai:</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="runner" class="peer sr-only" checked>
                            <div class="rounded-xl border-2 border-brand-border bg-white py-3 px-4 hover:bg-brand-light transition-all peer-checked:border-brand-teal peer-checked:bg-brand-teal/5 peer-checked:text-brand-teal text-center">
                                <span class="block font-bold text-sm">👟 Pelari</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="fotografer" class="peer sr-only">
                            <div class="rounded-xl border-2 border-brand-border bg-white py-3 px-4 hover:bg-brand-light transition-all peer-checked:border-brand-orange peer-checked:bg-brand-orange/5 peer-checked:text-brand-orange text-center">
                                <span class="block font-bold text-sm">📸 Fotografer</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full mt-4 bg-brand-navy text-white py-4 rounded-xl font-bold shadow-lg shadow-brand-navy/20 hover:bg-brand-teal hover:shadow-brand-teal/30 transition-all transform active:scale-[0.98] group flex justify-center items-center gap-2">
                    Buat Akun Sekarang
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-brand-muted font-medium">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-brand-teal hover:text-brand-navy">Masuk di sini</a>
            </div>
        </div>

        <!-- Right Side: Graphic/Branding (Hidden on small screens) -->
        <div class="hidden lg:flex w-1/2 bg-brand-navy relative overflow-hidden items-center justify-center p-12">
            <!-- Background Decorations -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-brand-teal opacity-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 w-72 h-72 rounded-full bg-brand-orange opacity-20 blur-3xl"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

            <!-- Absolute Logo -->
            <a href="/" class="absolute top-10 left-12 inline-flex items-center gap-2 z-20">
                <svg class="w-8 h-8 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-3xl font-black text-white tracking-tight">Run<span class="text-brand-teal">Snap</span></span>
            </a>

            <!-- Central Graphic & Motivational Text -->
            <div class="relative z-10 text-center flex flex-col items-center">
                <div class="w-48 h-48 mb-6 relative animate-float">
                    <!-- Glowing aura behind image -->
                    <div class="absolute inset-0 bg-brand-teal/30 rounded-full blur-xl transform scale-75"></div>
                    <!-- Using the runner asset -->
                    <img src="{{ asset('assets/org_lari.png') }}" alt="Runner Illustration" class="w-full h-full object-contain relative z-10 filter drop-shadow-2xl">
                </div>
                
                <h2 class="text-3xl font-black text-white mb-4 leading-tight">Satu Klik,<br>Ribuan Kenangan.</h2>
                <p class="text-brand-light/80 text-lg font-medium max-w-sm">Berhenti membuang waktu mencari foto di antara ribuan gambar. Biarkan AI kami yang menemukannya untukmu.</p>
                
                <!-- Trust badge -->
                <div class="mt-8 inline-flex items-center gap-3 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/20">
                    <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f525/512.gif" alt="Fire" class="w-5 h-5">
                    <span class="text-sm font-bold text-white tracking-wide uppercase">Powered by AI Recognition</span>
                </div>
            </div>
            
        </div>
    </div>

</body>
</html>
