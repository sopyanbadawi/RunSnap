<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RunSnap</title>
    
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
</head>
<body class="bg-brand-light font-sans antialiased text-brand-body min-h-screen flex flex-col">

    <!-- Subtle Header Brand -->
    <header class="h-20 flex items-center justify-center border-b border-brand-border bg-white shadow-sm shrink-0">
        <a href="/" class="text-2xl font-black text-brand-navy tracking-tighter flex items-center gap-1 group">
            <svg class="w-7 h-7 text-brand-teal transform group-hover:rotate-12 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Run<span class="text-brand-teal">Snap</span>
        </a>
    </header>

    <div class="flex-1 flex items-center justify-center p-6 bg-gradient-to-br from-brand-light to-white">
        <div class="max-w-2xl w-full text-center">
            <!-- Icon/Illustration -->
            <div class="flex justify-center mb-8">
                @yield('image')
            </div>

            <!-- Error Code -->
            <h1 class="text-7xl md:text-9xl font-black text-brand-navy tracking-tighter mb-4 opacity-90 drop-shadow-md">
                @yield('code')
            </h1>
            
            <!-- Message -->
            <h2 class="text-2xl md:text-3xl font-bold text-brand-teal mb-4">
                @yield('message')
            </h2>
            <p class="text-brand-muted text-lg font-medium mb-10 max-w-lg mx-auto">
                @yield('description')
            </p>

            <!-- Back Button -->
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-brand-navy rounded-2xl hover:bg-[#152A50] shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Minimal Footer -->
    <footer class="py-6 text-center text-brand-muted text-sm font-semibold bg-white border-t border-brand-border">
        &copy; {{ date('Y') }} RunSnap. Pelari Terdepan.
    </footer>

</body>
</html>
