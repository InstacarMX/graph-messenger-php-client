<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Text
{
    private string $body;

    private ?bool $previewUrl;

    public function __construct(string $body, bool $previewUrl = null)
    {
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
