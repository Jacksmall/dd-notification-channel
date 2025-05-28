<?php

namespace Jacksmall\DdNotificationChannel\Messages\Factory;

use Jacksmall\DdNotificationChannel\Messages\MessageBuilder;

abstract class AbstractDingDingMsgFactory
{
    abstract public function createBuilder(): MessageBuilder;

    public function create(array $params)
    {
        $builder = $this->createBuilder();
        return $builder->build($params);
    }
}