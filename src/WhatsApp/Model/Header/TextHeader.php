<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Header;

final class TextHeader extends Header
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getType(): string
    {
        return 'text';
    }

    public function getText(): string
    {
        return $this->text;
    }
}
