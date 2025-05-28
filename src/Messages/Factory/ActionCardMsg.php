<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\ActionCardMessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\Factory\AbstractDingDingMsgFactory;
use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

class ActionCardMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): ActionCardMessageBuilder
    {
        return new ActionCardMessageBuilder();
    }
}