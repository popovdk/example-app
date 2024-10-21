<?php

namespace App\Notifications;

use App\Package\TgNotify\TelegramChannel;
use App\Package\TgNotify\TelegramMessage;
use App\Package\TgNotify\TelegramNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Nette\Utils\Random;

class SendVerifyCode extends TelegramNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private string $code) {}

    public function via(object $notifiable): array
    {
        return [TelegramChannel::class, 'database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code' => $this->code,
            'email' => $notifiable->email
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'verify-code';
    }

    public function toTelegram($notifiable): TelegramMessage
    {
        return new TelegramMessage("Email: {$notifiable->email}. Код подтверждения: {$this->code}");
    }
}
