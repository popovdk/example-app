<?php

namespace App\Package\TgNotify;

use Illuminate\Notifications\Notification;

abstract class TelegramNotification extends Notification
{
    abstract public function toTelegram($notifiable): TelegramMessage;
}
