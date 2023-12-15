<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport;

final class Helpers
{
    private function __construct()
    {
    }

    public static ?\Closure $beforeGenerateDownloadUrl = null;

    public static function fileName(string $path): string
    {
        return substr($path, 37);
    }
}
