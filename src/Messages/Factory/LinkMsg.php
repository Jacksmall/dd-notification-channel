<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\LinkMessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

class LinkMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): MessageBuilder
    {
        return new LinkMessageBuilder();
    }
}