<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class FeedCardLinks
{
    public $title;
    public $messageURL;
    public $picURL;

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function messageURL($messageURL)
    {
        $this->messageURL = $messageURL;

        return $this;
    }

    public function picURL($picURL)
    {
        $this->picURL = $picURL;

        return $this;
    }
}