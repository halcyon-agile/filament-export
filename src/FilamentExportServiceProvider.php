<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport;

use HalcyonAgile\FilamentExport\Commands\PruneExportCommand;
use HalcyonAgile\FilamentExport\Http\Controllers\DownloadExportController;
use Illuminate\Routing\Middleware\ValidateSignature;
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
            ->hasCommand(PruneExportCommand::class);
    }

    //    public function packageBooted(): void
    //    {
    //        Route::get(
    //            config('filament-export.http.route.path').'/{fileName}',
    //            DownloadExportController::class
    //        )
    //            ->where('fileName', '.*')
    ////            ->middleware(ValidateSignature::relative())
    //            ->middleware(config('filament-export.http.route.middleware'))
    //            ->name(config('filament-export.http.route.name'));
    //    }
}
