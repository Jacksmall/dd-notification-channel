<?php

namespace Jacksmall\DdNotificationChannel\Messages;

use Closure;

class DingDingMessage
{
    /**
     * message type (text,link,markdown,ActionCard,FeedCard)
     *
     * @var string
     */
    public $msgtype = 'text';

    /**
     * when msgtype in (text)
     * message content
     *
     * @var string
     */
    public $content;

    /**
     * when msgtype in (text,markdown)
     * the message content need @ mobiles
     *
     * @var array
     */
    public $atMobiles = [];

    /**
     * when msgtype in (text,markdown)
     * the message content need @ userIds
     *
     * @var array
     */
    public $atUserIds = [];

    /**
     * when msgtype in (text,markdown)
     * need @ all peoples
     *
     * @var bool
     */
    public $isAtAll = false;

    /**
     * when msgtype in (link,markdown,ActionCard,FeedCard)
     * message title
     *
     * @var string
     */
    public $title;

    /**
     * when msgtype in (link,markdown,ActionCard)
     * message text
     *
     * @var string
     */
    public $text;

    /**
     * when msgtype in (link,FeedCard)
     * message url
     * click redirect url
     *
     * @var string
     */
    public $messageUrl;

    /**
     * when msgtype in (link,FeedCard)
     * picture url
     *
     * @var string
     */
    public $picUrl = '';

    /**
     * when msgtype in (ActionCard)
     * set this option then btns option is invalid
     *
     * @var string
     */
    public $singleTitle;

    /**
     * when msgtype in (ActionCard)
     * click redirect url
     *
     * @var string
     */
    public $singleURL;

    /**
     * when msgtype in (ActionCard)
     * btn orientation
     * when 0 then y
     * when 1 then x
     *
     * @var int
     */
    public $btnOrientation = 1;

    /**
     * when msgtype in (ActionCard)
     *
     * @var array
     */
    public $btns = [];

    /**
     * the message send to channel
     *
     * @var string|null
     */
    public $channel;

    /**
     * The message's link object
     *
     * @var array
     */
    public $link;

    /**
     * @var array
     */
    public $allActionCard;

    /**
     * @var array
     */
    public $singleActionCard;

    /**
     * @var array
     */
    public $feedCard;

    public $http = [];

    /**
     * @return $this
     */
    public function text()
    {
        $this->msgtype = 'text';

        return $this;
    }

    public function link()
    {
        $this->msgtype = 'link';

        return $this;
    }

    public function markdown()
    {
        $this->msgtype = 'markdown';

        return $this;
    }

    public function allActionCard()
    {
        $this->msgtype = 'ActionCard';

        return $this;
    }

    public function singleActionCard()
    {
        $this->msgtype = 'ActionCard';

        return $this;
    }

    public function feedCard()
    {
        $this->msgtype = 'FeedCard';

        return $this;
    }

    public function at($atMobiles = [], $atUserIds = [], $isAtAll = false)
    {
        $this->atMobiles = $atMobiles;
        $this->atUserIds = $atUserIds;
        $this->isAtAll = $isAtAll;

        return $this;
    }

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function to($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function textContent($text)
    {
        $this->text = $text;

        return $this;
    }

    public function messageUrl($messageUrl)
    {
        $this->messageUrl = $messageUrl;

        return $this;
    }

    public function picUrl($picUrl)
    {
        $this->picUrl = $picUrl;

        return $this;
    }

    public function linkContent()
    {
        $this->link = [
            'title' => $this->title,
            'text' => $this->text,
            'messageUrl' => $this->messageUrl,
            'picUrl' => $this->picUrl
        ];

        return $this;
    }

    public function btnOrientation($btnOrientation)
    {
        $this->btnOrientation = (string)$btnOrientation;

        return $this;
    }

    public function singleTitle($singleTitle)
    {
        $this->singleTitle = $singleTitle;

        return $this;
    }

    public function singleURL($singleURL)
    {
        $this->singleURL = $singleURL;

        return $this;
    }

    public function allActionCardContent()
    {
        $this->allActionCard = [
            'title' => $this->title,
            'text' => $this->text,
            'btnOrientation' => $this->btnOrientation,
            'singleTitle' => $this->singleTitle,
            'singleURL' => $this->singleURL
        ];

        return $this;
    }

    public function btnsOption(Closure $callback)
    {
        $this->btns[] = $btn = new BtnsOption;

        $callback($btn);

        return $this;
    }

    public function singleActionCardContent()
    {
        $this->singleActionCard = [
            'title' => $this->title,
            'text' => $this->text,
            'btnOrientation' => $this->btnOrientation,
            'btns' => $this->btns
        ];

        return $this;
    }

    public function feedCardAttachment(Closure $callback)
    {
        $this->feedCard[] = $link = new FeedCardLinks;

        $callback($link);

        return $this;
    }

    public function http(array $options)
    {
        $this->http = $options;

        return $this;
    }
}