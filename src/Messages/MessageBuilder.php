<?php

namespace Jacksmall\DdNotificationChannel\Messages;

interface MessageBuilder
{
    /**
     * build message strategy
     *
     * @param array $params
     * @return mixed
     */
    public function build(array $params);
}
