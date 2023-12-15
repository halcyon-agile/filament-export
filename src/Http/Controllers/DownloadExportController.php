<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport\Http\Controllers;

use HalcyonAgile\FilamentExport\Helpers;
use Illuminate\Support\Facades\Storage;

class DownloadExportController
{
    public function __invoke(string $path): mixed
    {
        return Storage::disk(config('filament-export.disk_name'))
            ->download($path, Helpers::fileName($path));
    }
}
