<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class DateTime
{
    private string $fallbackValue;

    public function __construct(string $fallbackValue)
    {
        $this->fallbackValue = $fallbackValue;
    }

    public function getFallbackValue(): string
    {
        return $this->fallbackValue;
    }
}
