<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ClearCacheController extends Controller
{
    public function __invoke(): Response
    {
        $results = [];

        // Clear compiled views (termasuk Livewire cached views)
        Artisan::call('view:clear');
        $results[] = '✓ View cache cleared';

        // Hapus manual livewire view cache kalau masih ada
        $livewireViewPath = storage_path('framework/views/livewire');
        if (File::isDirectory($livewireViewPath)) {
            File::cleanDirectory($livewireViewPath);
            $results[] = '✓ Livewire view cache cleared';
        }

        // Clear config cache
        Artisan::call('config:clear');
        $results[] = '✓ Config cache cleared';

        // Clear route cache
        Artisan::call('route:clear');
        $results[] = '✓ Route cache cleared';

        // Clear application cache
        Artisan::call('cache:clear');
        $results[] = '✓ Application cache cleared';

        // Clear event cache
        Artisan::call('event:clear');
        $results[] = '✓ Event cache cleared';

        return response(implode("\n", $results), 200);
    }
}
