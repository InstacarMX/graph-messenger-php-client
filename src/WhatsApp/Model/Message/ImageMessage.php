<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\ImageMedia;

final class ImageMessage extends Message
{
    private ImageMedia $image;

    public function __construct(string $to, ImageMedia $image, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->image = $image;
    }

    public function getType(): string
    {
        return 'image';
    }

    public function getImage(): ImageMedia
    {
        return $this->image;
    }
}
