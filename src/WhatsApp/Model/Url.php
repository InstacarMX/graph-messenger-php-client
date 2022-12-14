<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Url
{
    private ?string $type;

    private string $url;

    public function __construct(string $url, ?string $type = null)
    {
        if ($type !== null && !\in_array($type, ['HOME', 'WORK'])) {
            throw new \InvalidArgumentException(sprintf('The type must be "HOME" or "WORK", "%s" given.', $type));
        }

        $this->type = $type;
        $this->url = $url;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
