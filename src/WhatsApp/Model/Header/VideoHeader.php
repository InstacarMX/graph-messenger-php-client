<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Header;

use Instacar\GraphMessengerApi\WhatsApp\Model\Media\VideoMedia;

final class VideoHeader extends Header
{
    private VideoMedia $video;

    public function __construct(VideoMedia $video)
    {
        $this->video = $video;
    }

    public function getType(): string
    {
        return 'video';
    }

    public function getDocument(): VideoMedia
    {
        return $this->video;
    }
}
