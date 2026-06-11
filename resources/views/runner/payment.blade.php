<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran - RunSnap</title>
    
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
<body class="bg-brand-light font-sans antialiased text-brand-body min-h-screen flex flex-col items-center justify-center">

    <div class="max-w-xl w-full px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden border border-brand-border shadow-xl rounded-3xl p-8 sm:p-10 text-center">
            
            <div class="mb-6 flex justify-center">
                <div class="h-20 w-20 bg-brand-teal/10 text-brand-teal rounded-full flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-2xl sm:text-3xl font-black text-brand-navy mb-2 tracking-tight">Selesaikan Pembayaran</h2>
            <p class="text-brand-muted mb-8 font-medium">Total Tagihan: <br><span class="font-black text-brand-teal text-3xl mt-1 block">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span></p>

            <!-- Tombol Bayar Manual (Jika Pop-up tidak otomatis muncul atau tertutup) -->
            <button id="pay-button" class="w-full bg-brand-teal hover:bg-brand-tealHover text-white font-black py-4 px-4 rounded-xl transition-all shadow-lg shadow-brand-teal/20 transform hover:-translate-y-1">
                Lanjutkan Pembayaran
            </button>
            
            <a href="{{ route('runner.cart') }}" class="block mt-4 text-sm font-bold text-brand-muted hover:text-brand-navy transition-colors">
                Batal & Kembali ke Keranjang
            </a>

            <p class="mt-8 text-xs font-bold text-gray-400">Order ID: {{ $transaction->external_id }}</p>

            <!-- Script Midtrans -->
            <script src="{{ env('MIDTRANS_IS_PRODUCTION', false) ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function () {
                    // Memanggil pop-up Snap
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            // Aksi saat pembayaran berhasil
                            window.location.href = "{{ route('runner.gallery') }}";
                        },
                        onPending: function(result){
                            // Aksi saat menunggu pembayaran (misal VA Transfer belum dilakukan)
                            alert("Menunggu konfirmasi pembayaran! Jika menggunakan VA/Indomaret, silakan selesaikan transfer agar foto terbuka.");
                            window.location.href = "{{ route('runner.transactions') }}";
                        },
                        onError: function(result){
                            // Aksi saat pembayaran gagal
                            alert("Pembayaran gagal atau kedaluwarsa!");
                            window.location.href = "{{ route('runner.cart') }}";
                        },
                        onClose: function(){
                            // Aksi saat pengguna menutup pop-up tanpa membayar
                            console.log('Kasir pop-up ditutup oleh pengguna');
                        }
                    });
                };

                // Otomatis buka pop-up saat halaman pertama dimuat
                window.onload = function() {
                    setTimeout(function(){
                        document.getElementById('pay-button').click();
                    }, 500); // delay 0.5 detik agar animasi mulus
                };
            </script>
        </div>
    </div>

</body>
</html>
