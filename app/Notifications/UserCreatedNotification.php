<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class UserCreatedNotification extends Notification
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
            ->content('Benutzer wurde angelegt: '.$notifiable->name.' ('.$notifiable->email.')');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
