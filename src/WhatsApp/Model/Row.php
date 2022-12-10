<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Row
{
    private string $id;

    private string $title;

    private ?string $description;

    public function __construct(string $id, string $title, ?string $description = null)
    {
        if (\strlen($id) > 200) {
            throw new \InvalidArgumentException('The id of the row must be 200 characters or less');
        }
        if (\strlen($title) > 24) {
            throw new \InvalidArgumentException('The title of the row must be 24 characters or less');
        }
        if ($description !== null && \strlen($description) > 72) {
            throw new \InvalidArgumentException('The description of the row must be 72 characters or less');
        }

        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
