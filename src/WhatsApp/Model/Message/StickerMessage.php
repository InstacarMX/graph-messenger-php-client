<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\StickerMedia;

final class StickerMessage extends Message
{
    private StickerMedia $sticker;

    public function __construct(string $to, StickerMedia $sticker, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->sticker = $sticker;
    }

    public function getType(): string
    {
        return 'sticker';
    }

    public function getSticker(): StickerMedia
    {
        return $this->sticker;
    }
}
