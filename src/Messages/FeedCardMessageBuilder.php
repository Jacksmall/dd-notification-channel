<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class FeedCardMessageBuilder implements MessageBuilder
{

    /**
     * @inheritDoc
     */
    public function build(array $params)
    {
        return [
            'msgtype' => 'feedCard',
            'feedCard' => [
                'links' => $params['links'] ?? [
                        [
                            'title' => '第一条',
                            'messageURL' => 'https://example.com/1',
                            'picURL' => 'https://img.example.com/1.jpg'
                        ]
                    ]
            ]
        ];
    }
}