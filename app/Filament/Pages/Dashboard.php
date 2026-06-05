<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // 🟢 1. Mengubah nama title di judul halaman besar & tab browser
    public function getTitle(): string
    {
        return 'Halaman Admin'; // 👈 Ganti dengan nama yang Anda inginkan
    }

    // 🟢 2. Mengubah nama teks yang muncul di menu navigasi samping kiri
    public static function getNavigationLabel(): string
    {
        return 'Halaman Admin'; // 👈 Ganti dengan nama yang Anda inginkan
    }
}