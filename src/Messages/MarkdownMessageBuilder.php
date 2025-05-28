<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class MarkdownMessageBuilder implements MessageBuilder
{

    /**
     * @inheritDoc
     */
    public function build(array $params)
    {
        return [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $params['title'] ?? 'Markdown标题',
                'text' => $params['text'] ?? '### Markdown内容'
            ],
            'at' => [
                'atMobiles' => $params['atMobiles'] ?? [],
                'atUserIds' => $params['atUserIds'] ?? [],
                'isAtAll' => $params['isAtAll'] ?? false
            ]
        ];
    }
}
