<?php

namespace Jacksmall\DdNotificationChannel;

use Jacksmall\DdNotificationChannel\Messages\Factory\ActionCardMsg;
use Jacksmall\DdNotificationChannel\Messages\Factory\FeedCardMsg;
use Jacksmall\DdNotificationChannel\Messages\Factory\LinkMsg;
use Jacksmall\DdNotificationChannel\Messages\Factory\MarkdownMsg;
use Jacksmall\DdNotificationChannel\Messages\Factory\TextMsg;

class DingDingFactoryRouter
{
    private static $cachedFactories = [];

    const MAPPING = [
        'text' => TextMsg::class,
        'link' => LinkMsg::class,
        'markdown' => MarkdownMsg::class,
        'actionCard' => ActionCardMsg::class,
        'feedCard' => FeedCardMsg::class
    ];

    /**
     * @param $type
     * @return mixed
     * @throws \Exception
     */
    public static function createFactory($type)
    {
        if (isset(self::$cachedFactories[$type])) {
            return self::$cachedFactories[$type];
        }

        if (!isset(self::MAPPING[$type])) {
            throw new \Exception("无效的通知类型: {$type}");
        }

        $factoryName = self::MAPPING[$type];
        $factory = new $factoryName();

        return self::$cachedFactories[$type] = $factory;
    }
}