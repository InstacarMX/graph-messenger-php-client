<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Location;

final class LocationMessage extends Message
{
    private Location $location;

    public function __construct(string $to, Location $location, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->location = $location;
    }

    public function getType(): string
    {
        return 'location';
    }

    public function getLocation(): Location
    {
        return $this->location;
    }
}
