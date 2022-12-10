<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Button;

use Instacar\GraphMessengerApi\WhatsApp\Model\Reply;

final class ReplyButton extends Button
{
    private Reply $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function getType(): string
    {
        return 'reply';
    }

    public function getReply(): Reply
    {
        return $this->reply;
    }
}
