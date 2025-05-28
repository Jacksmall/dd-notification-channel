<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\MarkdownMessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

class MarkdownMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): MarkdownMessageBuilder
    {
        return new MarkdownMessageBuilder();
    }
}