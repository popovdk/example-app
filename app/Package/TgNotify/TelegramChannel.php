<?php

namespace App\Package\TgNotify;

use Illuminate\Support\Facades\Log;
use SergiX44\Nutgram\Nutgram;

class TelegramChannel
{
    public function send(object $notifiable, TelegramNotification $notification): void
    {
        $message = $notification->toTelegram($notifiable);

        $bot = new Nutgram(env('TG_VERIFY_BOT_TOKEN'));
        $bot->sendMessage($message->getText(), env('TG_VERIFY_CHANNEL_CHAT_ID'));

        Log::info($message->getText());
    }
}
