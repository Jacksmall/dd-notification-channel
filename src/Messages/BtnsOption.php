<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class BtnsOption
{
    public $actionURL;
    public $title;

    public function btn($title, $actionURL)
    {
        $this->title = $title;
        $this->actionURL = $actionURL;

        return $this;
    }
}