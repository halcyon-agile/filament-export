<?php

namespace HalcyonAgile\FilamentExport;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HalcyonAgile\FilamentExport\Commands\FilamentExportCommand;

class FilamentExportServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-export')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-export_table')
            ->hasCommand(FilamentExportCommand::class);
    }
}
