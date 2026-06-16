<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class StorageLinkController extends Controller
{
    public function __invoke(): Response
    {
        $publicPath  = public_path('storage');
        $targetPath  = storage_path('app/public');

        // Sudah ada dan valid
        if (is_link($publicPath) && readlink($publicPath) === $targetPath) {
            return response('Storage link sudah ada dan aktif.', 200);
        }

        // Broken symlink — hapus dulu
        if (is_link($publicPath)) {
            unlink($publicPath);
        }

        // Ada sebagai folder biasa, tidak bisa diproses otomatis
        if (is_dir($publicPath)) {
            return response('public/storage sudah ada sebagai folder biasa. Hapus folder tersebut secara manual terlebih dahulu.', 409);
        }

        // Pastikan storage/app/public ada
        if (!is_dir($targetPath)) {
            mkdir($targetPath, 0775, true);
        }

        Artisan::call('storage:link');

        if (is_link($publicPath)) {
            return response('Storage link berhasil dibuat.', 200);
        }

        return response('Gagal membuat storage link: ' . trim(Artisan::output()), 500);
    }
}
