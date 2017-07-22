<?php

namespace ImproveWriting\Messaging;

class Messenger
{
    const CLI = 'cli';
    const SLACK = 'slack';
    const TELEGRAM = 'telegram';

    /** @var Medium */
    private $sender = null;

    public function __construct($type = self::CLI)
    {
        switch ($type) {
            case self::SLACK:
                $this->sender = new Slack();
                break;
            case self::TELEGRAM:
                $this->sender = new Telegram();
                break;
            case self::CLI:
            default:
                $this->sender = new CLI();
        }
    }

    public function setErrorBlock($value)
    {

    }

    public function output($message)
    {
        $this->sender->output($message);
    }

    public function send()
    {
        $this->sender->send();
    }
}

