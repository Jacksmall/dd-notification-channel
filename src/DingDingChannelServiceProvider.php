<?php

namespace Jacksmall\DdNotificationChannel;

use GuzzleHttp\Client;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Jacksmall\DdNotificationChannel\Channels\DingDingChannel;

class DingDingChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('dingding', function ($app) {
                return new DingDingChannel($app->make(Client::class, [
                    'config'  => [
                        'verify' => false
                    ]
                ]));
            });
        });
    }
}