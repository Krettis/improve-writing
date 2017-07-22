<?php

namespace ImproveWriting\Messaging;

use TelegramBot\Api\BotApi as TelegramBot;

class Telegram implements Medium
{
    /** @var TelegramBot */
    private $bot;
    private $outputs = [];

    public function __construct()
    {
        $this->bot = new TelegramBot(getenv('TELEGRAM_WRITING_BOT_TOKEN'));
    }

    public function output($message)
    {
        $this->outputs[] = $message;
    }

    public function send()
    {
        $chatId = getenv('TELEGRAM_WRITING_BOT_CHAT_ID');


        $this->bot->sendMessage($chatId, implode('', $this->outputs));
    }
}
