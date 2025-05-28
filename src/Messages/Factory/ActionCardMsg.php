<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\ActionCardMessageBuilder;
use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

class ActionCardMsg extends AbstractDingDingMsgFactory
{

    public function createBuilder(): MessageBuilder
    {
        return new ActionCardMessageBuilder();
    }
}