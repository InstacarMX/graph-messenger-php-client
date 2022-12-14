<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Reply
{
    private string $id;

    private string $title;

    public function __construct(string $id, string $title)
    {
        if (\strlen($id) > 256) {
            throw new \InvalidArgumentException('The id button must be 256 characters or less');
        }
        if (\strlen($title) > 20) {
            throw new \InvalidArgumentException('The title button must be 20 characters or less');
        }

        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
