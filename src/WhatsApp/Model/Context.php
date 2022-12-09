<?php

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Context
{
    private string $messageId;

    public function __construct(string $messageId)
    {
        $this->messageId = $messageId;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }
}