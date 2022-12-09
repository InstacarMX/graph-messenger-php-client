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
