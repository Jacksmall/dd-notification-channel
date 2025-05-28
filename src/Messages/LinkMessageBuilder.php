<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class LinkMessageBuilder implements MessageBuilder
{

    /**
     * @inheritDoc
     */
    public function build(array $params)
    {
        return [
            'msgtype' => 'link',
            'link' => [
                'text' => $params['text'] ?? '',
                'title' => $params['title'] ?? '',
                'picUrl' => $params['picUrl'] ?? '',
                'messageUrl' => $params['messageUrl'] ?? ''
            ]
        ];
    }
}