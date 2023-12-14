<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport;

use Filament\Notifications\Notification;
use HalcyonAgile\FilamentExport\Events\ExportFinishedEvent;
use Illuminate\Support\Str;

class ExcelExport extends \pxlrbt\FilamentExcel\Exports\ExcelExport
{
    //    #[\Override] TODO: php 8.3 override
    public function export()
    {
        $this->resolveFilename();
        $this->resolveWriterType();

        if (! $this->isQueued()) {
            return $this->downloadExport($this->getFilename(), $this->getWriterType());
        }

        $this->prepareQueuedExport();

        $filename = Str::uuid().'-'.$this->getFilename();
        $user = auth()->user();

        $this
            ->queueExport($filename, config('filament-export.disk_name'), $this->getWriterType())
            ->chain([
                fn () => event(new ExportFinishedEvent(filename: $filename, notifiable: $user)),
            ]);

        Notification::make()
            ->title(__('filament-excel::notifications.queued.title'))
            ->body(__('filament-excel::notifications.queued.body'))
            ->success()
            ->seconds(5)
            ->icon('heroicon-o-inbox-in')
            ->send();
    }
}
