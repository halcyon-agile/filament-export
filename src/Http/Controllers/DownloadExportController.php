<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport\Http\Controllers;

use HalcyonAgile\FilamentExport\Helpers;
use Illuminate\Support\Facades\Storage;

class DownloadExportController
{
    public function __invoke(string $fileName): mixed
    {
        $path = Helpers::fullPath($fileName);

        $storage = Storage::disk(config('filament-export.temporary_files.disk'));

        if ($storage->exists($path)) {
            try {
                return $storage->download($path, $fileName);
            } catch (\Exception $e) {
                report($e);

                abort(500, 'Failed to download export.');
            }
        }

        abort(404);
    }
}
