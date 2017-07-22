<?php
namespace ImproveWriting\Handler;

use ImproveWriting\Helpers\Colors;
use ImproveWriting\Messaging\Messenger;

abstract Class LineCallBack implements LineHandle
{

    public static function create(Messenger $messenger)
    {
        return (new static())->setMessenger($messenger);
    }

    /** @var Messenger */
    private $messenger = null;

    protected $colors;

    public function __construct()
    {
        $this->colors = new Colors();
    }

    public final function setMessenger(Messenger $messenger)
    {
        $this->messenger = $messenger;

        return $this;
    }

    public function pushLine($content, $lineNumber)
    {
        $this->output($lineNumber);
    }

    protected final function output($m)
    {
        $this->messenger->output($m);
    }
}
