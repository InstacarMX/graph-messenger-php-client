<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Reaction
{
    private string $messageId;

    private string $emoji;

    public function __construct(string $messageId, string $emoji)
    {
        $this->messageId = $messageId;
        $this->emoji = $emoji;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function getEmoji(): string
    {
        return $this->emoji;
    }
}
