<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class QuestionCreatedNotification extends Notification
{
    public function __construct() {}

    public function via($notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->to(config('services.telegram-bot-api.chat_id'))
            ->content('Eine neue Frage wurde angelegt: '.$notifiable->text);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
