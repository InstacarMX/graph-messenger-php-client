<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Parameter;

final class ButtonPayloadParameter
{
    private string $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    public function getType(): string
    {
        return 'payload';
    }

    public function getPayload(): string
    {
        return $this->payload;
    }
}
