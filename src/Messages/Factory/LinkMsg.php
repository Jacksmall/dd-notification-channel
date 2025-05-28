<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\Factory\AbstractDingDingMsgFactory;
use Jacksmall\DdNotificationChannel\Messages\LinkMessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

class LinkMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): LinkMessageBuilder
    {
        return new LinkMessageBuilder();
    }
}