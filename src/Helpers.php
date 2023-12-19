<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport;

final class Helpers
{
    private function __construct()
    {
    }

    public static ?\Closure $beforeGenerateDownloadUrl = null;

    public static function fullPath(string $fileName): string
    {
        return config('filament-export.temporary_files.base_directory').'/'.$fileName;
    }
}
