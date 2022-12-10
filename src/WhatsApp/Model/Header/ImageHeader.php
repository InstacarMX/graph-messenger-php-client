<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Header;

use Instacar\GraphMessengerApi\WhatsApp\Model\Media\ImageMedia;

final class ImageHeader extends Header
{
    private ImageMedia $image;

    public function __construct(ImageMedia $image)
    {
        $this->image = $image;
    }

    public function getType(): string
    {
        return 'image';
    }

    public function getDocument(): ImageMedia
    {
        return $this->image;
    }
}
