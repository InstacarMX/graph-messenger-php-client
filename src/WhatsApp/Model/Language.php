<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Language
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getPolicy(): string
    {
        return 'deterministic';
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
