<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Footer
{
    private string $text;

    public function __construct(string $text)
    {
        if (\strlen($text) > 60) {
            throw new \InvalidArgumentException('The text must be 60 characters or less');
        }

        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
