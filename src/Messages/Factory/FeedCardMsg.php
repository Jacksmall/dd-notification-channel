<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\Factory\AbstractDingDingMsgFactory;
use Jacksmall\DdNotificationChannel\Messages\FeedCardMessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

class FeedCardMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): MessageBuilder
    {
        return new FeedCardMessageBuilder();
    }
}