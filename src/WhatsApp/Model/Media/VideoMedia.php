<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Media;

final class VideoMedia extends Media
{
    private ?string $caption;

    public function __construct(string $id = null, string $link = null, string $caption = null)
    {
        parent::__construct($id, $link);

        $this->caption = $caption;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }
}
