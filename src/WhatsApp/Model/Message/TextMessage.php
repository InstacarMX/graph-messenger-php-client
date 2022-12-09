<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Text;

final class TextMessage extends Message
{
    private Text $text;

    public function __construct(string $to, Text $text, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->text = $text;
    }

    public function getType(): string
    {
        return 'text';
    }

    public function getText(): Text
    {
        return $this->text;
    }
}
