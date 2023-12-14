<?php

declare(strict_types=1);

namespace HalcyonAgile\FilamentExport\Notifications;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use HalcyonAgile\FilamentExport\Helpers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class ExportFinishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly string $fileName)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * @throws \Exception
     */
    public function toDatabase(object $notifiable): array
    {
        return FilamentNotification::make()
            ->success()
            ->title('Export finished')
            ->body(trans('Your file [:filename] is ready for download.', ['filename' => $this->fileName]))
            ->icon('heroicon-o-download')
            ->actions([
                Action::make('download')
                    ->button()
                    ->url($this->downloadUrl()),
            ])
            ->getDatabaseMessage();
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->greeting('Export finished')
            ->line(trans('Your file [:filename] is ready for download.', ['filename' => $this->fileName]))
            ->action('Download', $this->downloadUrl());
    }

    protected function downloadUrl(): string
    {
        if (Helpers::$beforeGenerateDownloadUrl !== null) {
            value(Helpers::$beforeGenerateDownloadUrl);
        }

        return URL::temporarySignedRoute(
            config('filament-export.http.route.name'),
            now()->minutes(config('filament-export.expires_in_minute')),
            ['path' => $this->fileName]
        );
    }

    //    /**
    //     * horizon compatible tags
    //     */
    //    public function tags(): array
    //    {
    //        return  [];
    //    }
}
