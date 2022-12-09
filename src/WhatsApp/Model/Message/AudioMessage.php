<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\AudioMedia;

final class AudioMessage extends Message
{
    private AudioMedia $audio;

    public function __construct(string $to, AudioMedia $audio, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->audio = $audio;
    }

    public function getType(): string
    {
        return 'audio';
    }

    public function getAudio(): AudioMedia
    {
        return $this->audio;
    }
}
