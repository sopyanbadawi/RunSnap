@extends('errors.layout')

@section('title', 'Server Bermasalah')
@section('code', '500')
@section('message', 'Waduh, Server Sedang Kram Otot')
@section('description', 'Kami sedang mengalami masalah teknis atau server sedang kelebihan beban. Tim mekanik kami sedang memperbaikinya. Coba lagi dalam beberapa menit ya!')

@section('image')
<div class="relative w-32 h-32 md:w-40 md:h-40 animate-pulse">
    <div class="absolute inset-0 bg-brand-navy/20 rounded-full blur-2xl"></div>
    <div class="relative bg-white rounded-full p-6 md:p-8 shadow-xl border border-brand-border flex items-center justify-center h-full w-full">
        <svg class="w-16 h-16 md:w-20 md:h-20 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
    </div>
</div>
@endsection
