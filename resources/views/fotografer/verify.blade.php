<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - RunSnap</title>
    
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
        <div class="inline-flex items-center gap-2 mb-8">
            <svg class="w-8 h-8 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            <span class="text-2xl font-black text-brand-navy tracking-tight">Run<span class="text-brand-teal">Snap</span></span>
        </div>

        <!-- Graphic / Icon -->
        <div class="w-24 h-24 mx-auto mb-6 relative animate-float">
            <div class="absolute inset-0 bg-brand-teal/20 rounded-full blur-xl transform scale-75"></div>
            @if($user->verification_status === 'pending')
                <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f552/512.gif" alt="Pending Icon" class="w-full h-full object-contain relative z-10">
            @else
                <img src="https://fonts.gstatic.com/s/e/notoemoji/latest/1f4b3/512.gif" alt="KTP Icon" class="w-full h-full object-contain relative z-10">
            @endif
        </div>

        <h1 class="text-2xl font-black text-brand-navy tracking-tight mb-3">Verifikasi Identitas</h1>

        <!-- Notification Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-xs font-semibold rounded-xl text-left flex items-start gap-2.5">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-semibold rounded-xl text-left flex items-start gap-2.5">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if($user->verification_status === 'unverified')
            <p class="text-brand-muted text-sm font-medium leading-relaxed mb-6">
                Untuk dapat mulai mengunggah foto lari dan menjualnya, silakan unggah foto KTP Anda yang jelas dan valid untuk verifikasi oleh admin.
            </p>
        @elseif($user->verification_status === 'pending')
            <div class="mb-6 p-4 bg-amber-50 border border-amber-200 text-amber-800 text-xs font-semibold rounded-xl text-left flex flex-col gap-2">
                <div class="flex items-start gap-2.5">
                    <svg class="w-5 h-5 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Dokumen Sedang Ditinjau Admin</span>
                </div>
                <p class="text-amber-700 font-medium leading-relaxed mt-1">
                    Kami sedang meninjau dokumen KTP Anda. Proses verifikasi memerlukan waktu maksimal 1x24 jam. Terima kasih atas kesabaran Anda.
                </p>
            </div>
            
            @if($user->ktp_image)
                <div class="mb-6 rounded-2xl border border-brand-border overflow-hidden bg-brand-light">
                    <p class="text-xs font-bold text-brand-muted py-2 bg-white border-b border-brand-border">Foto KTP yang Diunggah</p>
                    <img src="{{ asset('storage/' . $user->ktp_image) }}" class="w-full h-auto max-h-40 object-cover" alt="KTP Preview">
                </div>
            @endif
        @elseif($user->verification_status === 'rejected')
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 text-xs font-semibold rounded-xl text-left flex flex-col gap-2">
                <div class="flex items-start gap-2.5">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-black text-sm">Verifikasi Ditolak</span>
                </div>
                <p class="text-red-700 font-medium leading-relaxed mt-1">
                    Alasan Penolakan: <strong class="text-red-900">"{{ $user->rejection_reason }}"</strong>
                </p>
                <p class="text-red-700 font-medium leading-relaxed mt-1">
                    Silakan unggah ulang foto KTP Anda yang lebih jelas dan valid di bawah ini.
                </p>
            </div>
        @endif

        <!-- Form & Actions -->
        <div class="space-y-4">
            @if($user->verification_status === 'unverified' || $user->verification_status === 'rejected')
                <form method="POST" action="{{ route('fotografer.verify.submit') }}" enctype="multipart/form-data" 
                    x-data="{ 
                        fileName: '',
                        handleFile(event) {
                            const file = event.target.files[0];
                            if (file) {
                                this.fileName = file.name;
                            }
                        }
                    }">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="ktp-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-brand-teal/50 rounded-2xl cursor-pointer bg-brand-teal/5 hover:bg-brand-teal/10 hover:border-brand-teal transition-all p-4">
                            <div class="flex flex-col items-center justify-center text-center">
                                <svg class="w-8 h-8 text-brand-teal mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                <span class="text-xs font-bold text-brand-navy" x-text="fileName ? fileName : 'Pilih Berkas KTP'"></span>
                                <span class="text-[10px] text-brand-muted mt-1" x-text="fileName ? 'Klik lagi untuk mengganti' : 'Format JPEG, PNG, JPG (Maks 5MB)'"></span>
                            </div>
                            <input id="ktp-file" type="file" name="ktp_image" class="hidden" accept="image/png, image/jpeg, image/jpg" @change="handleFile($event)" required />
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-brand-teal text-white py-3.5 rounded-xl font-bold shadow-lg shadow-brand-teal/20 hover:bg-brand-tealHover hover:shadow-brand-teal/30 transition-all text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        Kirim Verifikasi KTP
                    </button>
                </form>
            @endif

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
