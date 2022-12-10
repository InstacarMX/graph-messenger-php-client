<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Header;

abstract class Header
{
    abstract public function getType(): string;
}
