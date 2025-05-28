<?php

namespace Jacksmall\DdNotificationChannel\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use Jacksmall\DdNotificationChannel\Messages\DingDingMessage;
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

        return $this->http->post($url, $this->buildJsonPayload(
            $notification->toDingDing($notifiable)
        ));
    }

    /**
     * @param DingDingMessage $message
     * @return array
     */
    protected function buildJsonPayload(DingDingMessage $message)
    {
        $optionalFields = array_filter([
            'content' => data_get($message, 'content'),
            'atMobiles' => data_get($message, 'atMobiles'),
            'atUserIds' => data_get($message, 'atUserIds'),
            'isAtAll' => data_get($message, 'isAtAll'),
            'title' => data_get($message, 'title'),
            'messageUrl' => data_get($message, 'messageUrl'),
            'picUrl' => data_get($message, 'picUrl'),
            'singleTitle' => data_get($message, 'singleTitle'),
            'btnOrientation' => data_get($message, 'btnOrientation'),
        ]);
        return array_merge([
            'verify' => false,
            'json' => array_merge([
                'msgtype' => data_get($message, 'channel'),
                'text' => ['content' => data_get($message, 'text')]
            ], $optionalFields),
        ], $message->http);
    }
}