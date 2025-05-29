# Laravel DingTalk Notification Channel

<hr>

### 1.通过composer安装:<br/>
    ```
    composer require jacksmall/dd-notification-channel
    ```
### 2.在本地laravel项目中新建 config\dingding.php
```php
return [
    'robots' => [
        'default' => [
            'webhook_url' => env('DINGDING_DEFAULT_WEBHOOK_URL'),
            'secret' => env('DINGDING_DEFAULT_SECRET'),
        ],
        'marketing' => [
            'webhook_url' => env('DINGDING_MARKETING_WEBHOOK_URL', ''),
            'secret' => env('DINGDING_MARKETING_SECRET', ''),
        ],
        'finance' => [
            'webhook_url' => env('DINGDING_FINANCE_WEBHOOK_URL', ''),
            'secret' => env('DINGDING_FINANCE_SECRET', ''),
        ],
        'ops' => [
            'webhook_url' => env('DINGDING_OPS_WEBHOOK_URL', ''),
            'secret' => env('DINGDING_OPS_SECRET', ''),
        ],
    ]
];
```

### 3.在 .env 文件按需添加, access_token和secret自行提供
```
DINGDING_DEFAULT_WEBHOOK_URL=https://oapi.dingtalk.com/robot/send?access_token=xxx
DINGDING_DEFAULT_SECRET=xxxx
```

### 4.在本地laravel项目中新建
App\Services\DingDing\Config.php
```php
namespace App\Services\DingDing;

class Config
{
    protected $robots = [];

    public function __construct()
    {
        $this->robots = config('dingding.robots', []);
    }

    public function getRobotConfig(string $name = 'default')
    {
        return $this->robots[$name] ?? null;
    }

    public function getWebhookUrl(string $name = 'default'): string
    {
        return $this->getRobotConfig($name)['webhook_url'] ?? '';
    }

    public function getSecret(string $name = 'default'): string
    {
        return $this->getRobotConfig($name)['secret'] ?? '';
    }
}
```

App\Services\DingDing\Signer.php
```php
namespace App\Services\DingDing;

class Signer
{
    public function generate(string $secret): array
    {
        $timestamp = time() * 1000;
        $sign = base64_encode(hash_hmac('sha256', $timestamp . "\n" . $secret, $secret, true));
        return [urlencode($sign), $timestamp];
    }
}
```

App\Services\DingDingService.php
```php
namespace App\Services;

use App\Services\DingDing\Config;
use App\Services\DingDing\Signer;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class DingDingService
{
    protected $signer;
    protected $config;

    public function __construct(Config $config, Signer $signer)
    {
        $this->signer = $signer;
        $this->config = $config;
    }

    /**
     * @param string $robotName
     * @return string
     */
    public function getSignedUrl(string $robotName = 'default')
    {
        $url = $this->config->getWebhookUrl($robotName);
        $secret = $this->config->getSecret($robotName);

        if (empty($url) || empty($secret)) {
            throw new \InvalidArgumentException("Invalid DingDing config for: {$robotName}");
        }

        [$sign, $timestamp] = $this->signer->generate($secret);

        return "{$url}&timestamp={$timestamp}&sign={$sign}";
    }

    /**
     * @param Notification $notification
     * @param string $robotName
     * @return void
     */
    public function sendNotification(Notification $notification, string $robotName = 'default')
    {
        $url = $this->getSignedUrl($robotName);

        NotificationFacade::route('dingding', $url)->notify($notification);
    }
}
```

### 5.在本地laravel项目App\Providers\AppServiceProvider.php 中注册绑定服务:
```php
use App\Services\DingDing\Config;
use App\Services\DingDing\Signer;
use App\Services\DingDingService;
...
        $this->app->singleton(Config::class, function () {
            return new Config();
        });

        $this->app->singleton(Signer::class, function () {
            return new Signer();
        });

        $this->app->singleton(DingDingService::class, function($app) {
            return new DingDingService(
                $app->make(Config::class),
                $app->make(Signer::class)
            );
        });
...
```
### 6.在本地laravel项目按需建立notice类，测试如下
```
php artisan make:notification TestDingDingNotice
```
App\Notifications\TestDingDingNotice.php
```php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Jacksmall\DdNotificationChannel\Channels\DingDingChannel;

class TestDingDingNotice extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DingDingChannel::class];
    }

    /**
     * Get the dingding representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toDingDing($notifiable)
    {
        return [
            'type' => 'text',
            'params' => [
                'content' => $this->message
            ],
            'http' => [
                'verify' => false,
                'timeout' => 5
            ] // 可选 HTTP 参数
        ];
    }
}
```
### 7.调用如下
```php
    /**
     * @return void
     */
    public function dingTalkNotification(Request $request)
    {
        $notification = new TestDingDingNotice($request->input('message'));

        app(DingDingService::class)->sendNotification($notification, 'default');
    }
```

# ☺ ☺