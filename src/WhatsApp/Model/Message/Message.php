<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;

abstract class Message
{
    private string $to;

    private ?Context $context;

    public function __construct(string $to, Context $context = null)
    {
        $this->to = $to;
        $this->context = $context;
    }

    public function getMessagingProduct(): string
    {
        return 'whatsapp';
    }

    abstract public function getType(): string;

    public function getTo(): string
    {
        return $this->to;
    }

    public function getContext(): ?Context
    {
        return $this->context;
    }
}
