<?php

namespace ImproveWriting\Messaging;

use Maknz\Slack\Client;

class Slack implements Medium
{

    /** @var Client */
    private $client = null;

    public function __construct()
    {
        $this->client = new Client(getenv('SLACK_WEBHOOK_GENERAL'));
        $this->client->setDefaultUsername('improve-bot-writer');
    }

    public function output($message)
    {
        $this->client->createMessage()->send($message);
    }
}
