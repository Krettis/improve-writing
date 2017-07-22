<?php
namespace ImproveWriting\Messaging;

use ImproveWriting\Helpers\Colors;

class CLI implements Medium
{
    /** @var Colors */
    private $colors;
    private $outputs = [];

    public function __construct()
    {
        $this->colors = new Colors();
    }

    public function output($message)
    {
        $message = preg_replace(
            [
                '/%ERROR_STRONG%([\w\s]+)%ERROR_STRONG%/',
                '/%INFO_STRONG%([\w\s]+)%INFO_STRONG%/'
            ],
            [
                $this->colors->getColoredString('${1}', 'light_red'),
                $this->colors->getColoredString('${1}', 'blue'),
            ],
            $message);

        $this->outputs[] = ucfirst($message) . PHP_EOL;
    }

    public function send()
    {
        echo implode('', $this->outputs);
    }

}
