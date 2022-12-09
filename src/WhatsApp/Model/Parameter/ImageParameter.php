<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Parameter;

use Instacar\GraphMessengerApi\WhatsApp\Model\Media\ImageMedia;

final class ImageParameter extends Parameter
{
    private ImageMedia $image;

    public function __construct(ImageMedia $image)
    {
        $this->image = $image;
    }

    public function getImage(): ImageMedia
    {
        return $this->image;
    }
}
