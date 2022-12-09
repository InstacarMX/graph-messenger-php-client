<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Media;

final class DocumentMedia extends Media
{
    private ?string $caption;

    private ?string $filename;

    public function __construct(string $id = null, string $link = null, string $filename = null, string $caption = null)
    {
        parent::__construct($id, $link);

        $this->caption = $caption;
        $this->filename = $filename;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }
}
