<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Wajah - RunSnap</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
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
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'scan': 'scan 2.5s ease-in-out infinite',
                        'dash': 'dash 1.5s ease-in-out infinite',
                    },
                    keyframes: {
                        scan: {
                            '0%, 100%': { top: '0%' },
                            '50%': { top: '100%' }
                        },
                        dash: {
                            '0%': { strokeDashoffset: '0' },
                            '100%': { strokeDashoffset: '100' }
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        
        .camera-mask {
            mask-image: radial-gradient(circle, black 65%, transparent 70%);
            -webkit-mask-image: radial-gradient(circle, black 65%, transparent 70%);
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-brand-navy via-[#0B1B3A] to-[#152B52] font-sans text-brand-body min-h-screen flex items-center justify-center p-4 overflow-x-hidden relative">

    <!-- Background decorative blur shapes -->
    <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-brand-teal opacity-20 blur-3xl animate-pulse-slow"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-brand-orange opacity-15 blur-3xl animate-pulse-slow" style="animation-delay: 1.5s;"></div>

    <div class="max-w-md w-full glass-card rounded-[2.5rem] shadow-2xl border border-white/20 p-8 sm:p-10 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 mb-4">
                <svg class="w-8 h-8 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-2xl font-black text-brand-navy tracking-tight">Run<span class="text-brand-teal">Snap</span></span>
            </div>
            <h1 class="text-2xl font-black text-brand-navy tracking-tight">Pendaftaran Wajah</h1>
            <p class="text-brand-muted text-xs font-semibold mt-1">Langkah Terakhir Menyelesaikan Pendaftaran Runner</p>
        </div>

        <!-- Camera Area -->
        <div class="relative w-full aspect-square max-w-[280px] mx-auto mb-8">
            <!-- Animated circular border (scanning effect) -->
            <div class="absolute inset-0 rounded-full border-4 border-dashed border-brand-teal/30 animate-[spin_40s_linear_infinite] z-20"></div>
            
            <div class="absolute -inset-1 rounded-full border-2 border-brand-teal animate-pulse z-20"></div>

            <!-- Face Scanner Guide Line -->
            <div id="scannerLine" class="absolute left-0 right-0 h-1 bg-brand-teal shadow-[0_0_10px_#00C2B8] opacity-75 z-30 animate-scan pointer-events-none hidden"></div>

            <!-- Webcam Viewport -->
            <div class="w-full h-full rounded-full overflow-hidden relative bg-black shadow-inner z-10">
                <!-- Live camera stream -->
                <video id="video" class="w-full h-full object-cover scale-x-[-1]" autoplay playsinline></video>
                
                <!-- Freeze-frame capture canvas preview (hidden initially) -->
                <canvas id="canvas" class="absolute inset-0 w-full h-full object-cover scale-x-[-1] hidden"></canvas>

                <!-- Camera fallback icon & error display -->
                <div id="cameraPlaceholder" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 bg-slate-900 text-white z-20">
                    <svg class="w-16 h-16 text-slate-500 mb-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <p class="text-xs font-bold text-slate-400 leading-relaxed" id="cameraStatus">Menghubungkan Kamera...</p>
                </div>
            </div>
        </div>

        <!-- Instructions card -->
        <div id="instructionCard" class="bg-brand-light/60 border border-brand-border/60 rounded-2xl p-4 mb-8 text-left">
            <h4 class="text-xs font-black text-brand-navy mb-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Panduan Foto Wajah:
            </h4>
            <ul class="text-[10px] font-semibold text-brand-muted space-y-1 pl-5 list-disc leading-relaxed">
                <li>Pastikan wajah berada di tengah lingkaran pemandu.</li>
                <li>Gunakan pencahayaan yang terang dan merata.</li>
                <li>Hindari menggunakan kacamata hitam, topi, atau masker.</li>
                <li>Jaga ekspresi wajah netral (tidak tersenyum berlebihan).</li>
            </ul>
        </div>

        <!-- Notification Message -->
        <div id="alertBox" class="mb-6 p-4 rounded-xl text-xs font-semibold text-left items-start gap-2.5 hidden">
            <!-- Dynamic Alert Content -->
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <!-- State 1: Capture Action -->
            <button id="captureBtn" type="button" class="w-full bg-brand-teal text-white py-4 rounded-xl font-bold shadow-lg shadow-brand-teal/20 hover:bg-brand-tealHover hover:shadow-brand-teal/30 hover:-translate-y-0.5 transition-all active:scale-[0.98] text-sm flex items-center justify-center gap-2 group disabled:opacity-50 disabled:pointer-events-none" disabled>
                <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Ambil Foto Wajah
            </button>

            <!-- State 2: Confirmation Actions (Hidden by default) -->
            <div id="confirmGroup" class="grid grid-cols-2 gap-3 hidden">
                <button id="retakeBtn" type="button" class="bg-white border border-brand-border text-brand-navy hover:bg-slate-50 py-4 rounded-xl font-bold transition-all active:scale-[0.98] text-sm flex items-center justify-center gap-1.5">
                    Ulangi Foto
                </button>
                <button id="submitBtn" type="button" class="bg-brand-teal text-white hover:bg-brand-tealHover py-4 rounded-xl font-bold shadow-lg shadow-brand-teal/20 hover:shadow-brand-teal/30 transition-all active:scale-[0.98] text-sm flex items-center justify-center gap-1.5">
                    Kirim & Selesai
                </button>
            </div>

            <!-- Logout/Batal button -->
            <form method="POST" action="/runsnap/logout">
                @csrf
                <button type="submit" class="w-full bg-transparent text-brand-muted hover:text-brand-navy py-2 rounded-xl font-semibold transition-colors text-xs text-center mt-2">
                    Batal & Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Javascript Logic -->
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const submitBtn = document.getElementById('submitBtn');
        const confirmGroup = document.getElementById('confirmGroup');
        const cameraPlaceholder = document.getElementById('cameraPlaceholder');
        const cameraStatus = document.getElementById('cameraStatus');
        const scannerLine = document.getElementById('scannerLine');
        const alertBox = document.getElementById('alertBox');
        
        let localStream = null;

        // Initialize Camera
        async function startCamera() {
            try {
                cameraStatus.innerText = 'Meminta Izin Kamera...';
                const stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'user',
                        width: { ideal: 640 },
                        height: { ideal: 640 }
                    },
                    audio: false 
                });
                
                localStream = stream;
                video.srcObject = stream;
                
                // Hide camera status overlay and show guide line
                cameraPlaceholder.classList.add('hidden');
                scannerLine.classList.remove('hidden');
                captureBtn.disabled = false;
            } catch (err) {
                console.error("Error accessing camera: ", err);
                cameraPlaceholder.classList.remove('hidden');
                scannerLine.classList.add('hidden');
                captureBtn.disabled = true;
                
                if (err.name === 'NotAllowedError') {
                    cameraStatus.innerHTML = '<span class="text-red-400">Izin Kamera Ditolak</span><br><span class="text-[10px] text-slate-400 mt-2 block">Silakan aktifkan izin kamera pada browser Anda lalu muat ulang halaman ini.</span>';
                } else {
                    cameraStatus.innerHTML = '<span class="text-red-400">Gagal Mengakses Kamera</span><br><span class="text-[10px] text-slate-400 mt-2 block">Pastikan kamera Anda terhubung dan tidak sedang digunakan oleh aplikasi lain.</span>';
                }
            }
        }

        // Show Custom Alert
        function showAlert(message, type = 'error') {
            alertBox.innerHTML = '';
            alertBox.classList.remove('hidden', 'bg-red-50', 'border-red-200', 'text-red-700', 'bg-emerald-50', 'border-emerald-200', 'text-emerald-700');
            
            const isError = type === 'error';
            alertBox.classList.add(
                'flex',
                isError ? 'bg-red-50' : 'bg-emerald-50',
                isError ? 'border' : 'border',
                isError ? 'border-red-200' : 'border-emerald-200',
                isError ? 'text-red-700' : 'text-emerald-700'
            );
            
            const iconSvg = isError 
                ? '<svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>'
                : '<svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                
            alertBox.innerHTML = `${iconSvg}<span>${message}</span>`;
        }

        // Action Capture Foto
        captureBtn.addEventListener('click', () => {
            if (!localStream) return;

            const context = canvas.getContext('2d');
            
            // Set canvas size matching the video dimensions
            const videoWidth = video.videoWidth;
            const videoHeight = video.videoHeight;
            canvas.width = videoWidth;
            canvas.height = videoHeight;
            
            // Draw video frame to canvas
            context.drawImage(video, 0, 0, videoWidth, videoHeight);
            
            // Freeze view (show canvas, hide live video)
            video.classList.add('hidden');
            canvas.classList.remove('hidden');
            scannerLine.classList.add('hidden');
            
            // Toggle buttons state
            captureBtn.classList.add('hidden');
            confirmGroup.classList.remove('hidden');
        });

        // Action Ulangi Foto
        retakeBtn.addEventListener('click', () => {
            // Unfreeze view (show live video, hide canvas)
            video.classList.remove('hidden');
            canvas.classList.add('hidden');
            scannerLine.classList.remove('hidden');
            
            // Toggle buttons state
            captureBtn.classList.remove('hidden');
            confirmGroup.classList.add('hidden');
            alertBox.classList.add('hidden');
        });

        // Action Kirim Foto Selfie
        submitBtn.addEventListener('click', async () => {
            // Get base64 string from canvas
            const base64Image = canvas.toDataURL('image/jpeg', 0.9);

            // Set Loading state
            submitBtn.disabled = true;
            retakeBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengirim...
            `;

            try {
                const response = await fetch('{{ route("runner.selfie.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        image: base64Image
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showAlert(data.message, 'success');
                    // Redirect to dashboard on success
                    setTimeout(() => {
                        window.location.href = data.redirect_url;
                    }, 1000);
                } else {
                    showAlert(data.message || 'Gagal menyimpan foto. Silakan coba lagi.');
                    resetSubmitButton();
                }
            } catch (error) {
                console.error("Error submitting selfie: ", error);
                showAlert('Terjadi kesalahan koneksi server. Silakan coba lagi.');
                resetSubmitButton();
            }
        });

        function resetSubmitButton() {
            submitBtn.disabled = false;
            retakeBtn.disabled = false;
            submitBtn.innerHTML = 'Kirim & Selesai';
        }

        // Start camera on page load
        window.addEventListener('DOMContentLoaded', startCamera);
    </script>
</body>
</html>
