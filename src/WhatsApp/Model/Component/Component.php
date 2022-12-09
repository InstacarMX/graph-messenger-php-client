<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Component;

abstract class Component
{
    abstract public function getType(): string;
}
