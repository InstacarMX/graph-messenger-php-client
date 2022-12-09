<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Location
{
    private float $longitude;

    private float $latitude;

    private ?string $name;

    private ?string $address;

    public function __construct(float $longitude, float $latitude, string $name = null, string $address = null)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->name = $name;
        $this->address = $address;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
}
