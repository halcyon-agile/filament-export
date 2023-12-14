<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport;

use HalcyonAgile\FilamentExport\Commands\FilamentExportCommand;
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
}
