<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport;

use HalcyonAgile\FilamentExport\Commands\FilamentExportCommand;
use HalcyonAgile\FilamentExport\Http\Controllers\DownloadExportController;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentExportServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-export')
            ->hasConfigFile()
            ->hasCommand(FilamentExportCommand::class);
    }

    public function packageBooted(): void
    {
        // TODO: make PR on official package (pxlrbt/filament-excel) to allow for custom disk
        if (
            config('filament-export.disk_name') === 'filament-excel' ||
            ! in_array(config('filament-export.disk_name'), array_keys(config('filesystems.disks')))
        ) {
            config([
                'filesystems.disks.'.config('filament-export.disk_name') => config('filesystems.disks.s3'),
            ]);
        }

        Route::get(
            config('filament-export.http.route.path').'/{path}',
            DownloadExportController::class)
            ->middleware(config('filament-export.http.route.middleware'))
            ->where('path', '.*')
            ->name(config('filament-export.http.route.name'));
    }
}
