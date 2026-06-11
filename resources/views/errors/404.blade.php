@extends('errors.layout')

@section('title', 'Halaman Tidak Ditemukan')
@section('code', '404')
@section('message', 'Oops! Tersesat dari Jalur Lari')
@section('description', 'Halaman yang Anda cari mungkin sudah dipindah, dihapus, atau Anda salah mengetikkan alamat (URL). Ayo kembali ke jalur yang benar!')

@section('image')
<div class="relative w-32 h-32 md:w-40 md:h-40 animate-bounce">
    <div class="absolute inset-0 bg-brand-teal/20 rounded-full blur-2xl"></div>
    <div class="relative bg-white rounded-full p-6 md:p-8 shadow-xl border border-brand-border flex items-center justify-center h-full w-full">
        <svg class="w-16 h-16 md:w-20 md:h-20 text-brand-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
    </div>
</div>
@endsection
