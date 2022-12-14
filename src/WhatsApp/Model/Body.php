<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Body
{
    private string $text;

    public function __construct(string $text)
    {
        if (\strlen($text) > 1024) {
            throw new \InvalidArgumentException('The text must be 1024 characters or less');
        }

        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
