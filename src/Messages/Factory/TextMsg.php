<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\TextMessageBuilder;

class TextMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): MessageBuilder
    {
        return new TextMessageBuilder();
    }
}