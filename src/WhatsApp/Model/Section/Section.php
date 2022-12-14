<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Section;

abstract class Section
{
    private ?string $title;

    public function __construct(string $title = null)
    {
        if ($title !== null && \strlen($title) > 24) {
            throw new \InvalidArgumentException('The title must be 24 characters or less');
        }

        $this->title = $title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
