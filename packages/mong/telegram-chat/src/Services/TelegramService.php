<?php

namespace Mong\TelegramChat\Services;

use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramService
{
    public function sendMessage($chatId, $message)
    {
        Telegram::sendMessage(['chat_id' => $chatId, 'text' => $message]);
    }
}
