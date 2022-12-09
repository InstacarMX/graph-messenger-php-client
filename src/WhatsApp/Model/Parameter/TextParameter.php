<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Parameter;

use Instacar\GraphMessengerApi\WhatsApp\Model\Text;

final class TextParameter extends Parameter
{
    private Text $text;

    public function __construct(Text $text)
    {
        $this->text = $text;
    }

    public function getText(): Text
    {
        return $this->text;
    }
}
