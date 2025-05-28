<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class TextMessageBuilder implements MessageBuilder
{

    /**
     * @inheritDoc
     */
    public function build(array $params)
    {
        return [
            'msgtype' => 'text',
            'text' => [
                'content' => $params['content'] ?? '',
            ],
            'at' => [
                'atMobiles' => $params['atMobiles'] ?? [],
                'atUserIds' => $params['atUserIds'] ?? [],
                'isAtAll' => $params['isAtAll'] ?? false
            ]
        ];
    }
}
