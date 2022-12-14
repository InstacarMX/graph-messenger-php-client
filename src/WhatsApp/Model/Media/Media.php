<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Media;

abstract class Media
{
    private ?string $id;

    private ?string $link;

    public function __construct(string $id = null, string $link = null)
    {
        if ($id === null && $link === null) {
            throw new \LogicException('You must provide a "id" or a "link" parameter');
        }
        if ($link !== null && !(str_starts_with($link, 'https://') || str_starts_with($link, 'http://'))) {
            throw new \InvalidArgumentException('The link of the Media must start with https:// or http://');
        }

        $this->id = $id;
        $this->link = $link;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }
}
