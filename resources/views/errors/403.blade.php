@extends('errors.layout')

@section('title', 'Akses Ditolak')
@section('code', '403')
@section('message', 'Ups! Area Terlarang')
@section('description', 'Anda tidak memiliki izin untuk memasuki area ini. Pastikan Anda masuk dengan akun yang benar (Pelari atau Fotografer) untuk mendapatkan akses.')

@section('image')
<div class="relative w-32 h-32 md:w-40 md:h-40">
    <div class="absolute inset-0 bg-brand-orange/20 rounded-full blur-2xl"></div>
    <div class="relative bg-white rounded-full p-6 md:p-8 shadow-xl border border-brand-border flex items-center justify-center h-full w-full">
        <svg class="w-16 h-16 md:w-20 md:h-20 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
    </div>
</div>
@endsection
