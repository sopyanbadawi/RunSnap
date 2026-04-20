<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RunSnap</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { brand: { navy: '#0B1B3A', teal: '#00C2B8', light: '#F6F8FB', border: '#E6ECF2', muted: '#64748B' } }
                }
            }
        }
    </script>
</head>
<body class="bg-brand-light font-sans min-h-screen flex items-center justify-center p-4">

    <div class="max-w-6xl w-full bg-white rounded-[2rem] shadow-2xl border border-brand-border overflow-hidden flex flex-col lg:flex-row-reverse min-h-[600px]">
        
        <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
            <h1 class="text-3xl font-black text-brand-navy mb-2 text-center lg:text-left">Selamat Datang Kembali.</h1>
            <p class="text-brand-muted font-medium mb-8 text-center lg:text-left">Silakan masuk untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-brand-navy mb-1.5">Email Address</label>
                    <input type="email" name="email" required class="w-full px-4 py-3.5 rounded-xl border border-brand-border bg-brand-light focus:bg-white outline-none focus:ring-2 focus:ring-brand-teal/50 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-brand-navy mb-1.5">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-3.5 rounded-xl border border-brand-border bg-brand-light focus:bg-white outline-none focus:ring-2 focus:ring-brand-teal/50 transition-all">
                </div>
                
                <button type="submit" class="w-full bg-brand-navy text-white py-4 rounded-xl font-bold hover:bg-brand-teal transition-all shadow-lg">
                    Masuk Sekarang &rarr;
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-brand-muted">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-brand-teal hover:underline">Daftar di sini</a>
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
</body>
</html>