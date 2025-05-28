<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class ActionCardMessageBuilder implements MessageBuilder
{

    /**
     * @inheritDoc
     */
    public function build(array $params)
    {
        $card = [
            'title' => $params['title'] ?? '卡片标题',
            'text' => $params['text'] ?? '卡片内容',
            'singleTitle' => $params['singleTitle'] ?? '阅读全文',
            'singleURL' => $params['singleURL'] ?? '',
            'btnOrientation' => $params['btnOrientation'] ?? '0'
        ];

        // 独立跳转模式
        if (isset($params['btns'])) {
            $card['btns'] = $params['btns'];
            unset($card['singleTitle'], $card['singleURL']);
        }

        return [
            'msgtype' => 'actionCard',
            'actionCard' => $card
        ];
    }
}