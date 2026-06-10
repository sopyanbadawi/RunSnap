<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - RunSnap</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN) -->
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
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-8px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brand-light font-sans text-brand-body selection:bg-brand-teal selection:text-white min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-[2rem] shadow-2xl shadow-brand-navy/5 border border-brand-border p-8 sm:p-10 text-center opacity-0 animate-fade-in-up">
        
        <!-- Logo -->
        <a href="/" class="inline-flex items-center gap-2 mb-8">
            <svg class="w-8 h-8 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            <span class="text-2xl font-black text-brand-navy tracking-tight">Run<span class="text-brand-teal">Snap</span></span>
        </a>

        <!-- Graphic / Icon -->
        <div class="w-28 h-28 mx-auto mb-6 relative animate-float flex items-center justify-center">
            <div class="absolute inset-0 bg-brand-teal/20 rounded-full blur-xl transform scale-75"></div>
            <!-- Glow email svg -->
            <svg class="w-20 h-20 text-brand-teal relative z-10 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-black text-brand-navy tracking-tight mb-3">Verifikasi Email Kamu</h1>
        
        <p class="text-brand-muted text-sm font-medium leading-relaxed mb-6">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email kamu dengan mengeklik tautan yang baru saja kami kirimkan ke emailmu.
        </p>

        <!-- Alerts -->
        @if (session('message'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold rounded-xl text-left flex items-start gap-2.5">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold rounded-xl text-left flex items-start gap-2.5">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Action Forms -->
        <div class="space-y-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-brand-teal text-white py-3.5 rounded-xl font-bold shadow-lg shadow-brand-teal/20 hover:bg-brand-tealHover hover:shadow-brand-teal/30 transition-all transform active:scale-[0.98] text-sm">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="/runsnap/logout">
                @csrf
                <button type="submit" class="w-full bg-transparent text-brand-muted hover:text-brand-navy py-2 rounded-xl font-semibold transition-colors text-sm">
                    Keluar / Logout
                </button>
            </form>
        </div>

    </div>

</body>
</html>