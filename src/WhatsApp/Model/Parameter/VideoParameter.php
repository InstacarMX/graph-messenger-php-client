<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Parameter;

use Instacar\GraphMessengerApi\WhatsApp\Model\Media\VideoMedia;

final class VideoParameter extends Parameter
{
    private VideoMedia $video;

    public function __construct(VideoMedia $video)
    {
        $this->video = $video;
    }

    public function getVideo(): VideoMedia
    {
        return $this->video;
    }
}
