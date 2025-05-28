<?php

namespace Jacksmall\DdNotificationChannel\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use Jacksmall\DdNotificationChannel\DingDingFactoryRouter;
use Psr\Http\Message\ResponseInterface;

class DingDingChannel
{
    /**
     * @var Client $http
     */
    protected $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     * @return ResponseInterface|void
     * @throws GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $url = $notifiable->routeNotificationFor('dingding', $notification)) {
            return;
        }

        $message = $notification->toDingDing($notifiable);

        // 验证消息格式
        if (!is_array($message) || !isset($message['type']) || !isset($message['params'])) {
            throw new \InvalidArgumentException('toDingDing must return an array with type and params keys');
        }

        $messageBody = DingDingFactoryRouter::createFactory($message['type'])->create($message['params']);

        $options = [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $messageBody
        ];

        // 添加 HTTP 选项（如超时设置）
        if (isset($message['http'])) {
            $options = array_merge($options, $message['http']);
        }

        return $this->http->post($url, $options);
    }
}