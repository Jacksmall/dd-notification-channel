<?php

namespace Jacksmall\DdNotificationChannel\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
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

        return $this->http->post($url, $notification->toDingDing($notifiable));
    }
}