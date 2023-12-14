<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport\Commands;

use Illuminate\Console\Command;

class FilamentExportCommand extends Command
{
    public $signature = 'filament-export';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
