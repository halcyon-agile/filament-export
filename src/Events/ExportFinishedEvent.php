<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport\Events;

use Illuminate\Database\Eloquent\Model;

class ExportFinishedEvent
{
    public function __construct(
        public Model $notifiable,
        public string $filename,
    ) {
    }
}
