<?php

declare(strict_types=1);

use HalcyonAgile\FilamentExport\Commands\PruneExportCommand;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\artisan;
use function Pest\Laravel\freezeTime;
use function Pest\Laravel\travelTo;

it('prune export', function (bool $expired) {
    freezeTime();

    config([
        'filament-export.expires_in_minute' => 5,
        'filament-export.temporary_files.disk' => 'test-disk',
    ]);

    Storage::fake(config('filament-export.temporary_files.disk'));

    $exportDirectory = config('filament-export.temporary_files.base_directory');

    Storage::disk(config('filament-export.temporary_files.disk'))
        ->put($exportDirectory.'/test-export.csv', '');

    $minutes = config('filament-export.expires_in_minute');

    if ($expired) {
        $minutes++;
    }

    travelTo(now()->addMinutes($minutes));

    artisan(PruneExportCommand::class)
        ->assertSuccessful();

    if ($expired) {
        Storage::disk(config('filament-export.temporary_files.disk'))
            ->assertDirectoryEmpty($exportDirectory);
    } else {
        Storage::disk(config('filament-export.temporary_files.disk'))
            ->assertExists($exportDirectory.'/test-export.csv');
    }
})
    ->with([
        'expired' => true,
        'not expired' => false,
    ]);
