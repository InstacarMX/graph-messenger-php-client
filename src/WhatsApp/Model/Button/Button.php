<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Button;

abstract class Button
{
    abstract public function getType(): string;
}
