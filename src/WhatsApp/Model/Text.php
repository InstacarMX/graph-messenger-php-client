<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Text
{
    private string $body;

    private ?bool $previewUrl;

    public function __construct(string $body, bool $previewUrl = null)
    {
        if (strlen($body) > 4096) {
            throw new \InvalidArgumentException('The text must be 4096 characters or less');
        }

        $this->body = $body;
        $this->previewUrl = $previewUrl;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getPreviewUrl(): ?bool
    {
        return $this->previewUrl;
    }
}
