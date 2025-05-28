<?php

namespace Jacksmall\DdNotificationChannel\Messages;

class DingDingMessageFactory
{
    public static function create(string $type, array $params): array
    {
        $builder = self::getBuilder($type);
        return $builder->build($params);
    }

    protected static function getBuilder(string $type): MessageBuilder
    {
        switch ($type) {
            case 'text':
                return new TextMessageBuilder();
            case 'link':
                return new LinkMessageBuilder();
            case 'markdown':
                return new MarkdownMessageBuilder();
            case 'actionCard':
                return new ActionCardMessageBuilder();
            case 'feedCard':
                return new FeedCardMessageBuilder();
            default:
                throw new \InvalidArgumentException("Unsupported message type: {$type}");
        }
    }
}
