<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DownloadExportController
{
    public function __invoke(string $path): mixed
    {
        // TODO: sign url checks

        return response()
            ->download(
                Storage::disk(config('filament-export.disk_name'))
                    ->path($path),
                substr($path, 37)
            )
            ->deleteFileAfterSend();
    }
}
