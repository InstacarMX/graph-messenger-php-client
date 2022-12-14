<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Address
{
    private ?string $type;

    private ?string $countryCode;

    private ?string $country;

    private ?string $zip;

    private ?string $state;

    private ?string $city;

    private ?string $street;

    public function __construct(
        string $countryCode = null,
        string $country = null,
        string $zip = null,
        string $state = null,
        string $city = null,
        string $street = null,
        string $type = null,
    ) {
        if ($countryCode === null && $country === null && $zip === null && $state === null && $city === null && $street === null) {
            throw new \LogicException('You must provide at least one of the following parameters: countryCode, country, zip, state, city, street');
        }
        if ($countryCode !== null && strlen($countryCode) !== 2) {
            throw new \InvalidArgumentException('The country code of the Address must be a 2-letters ISO 3166-1 code');
        }
        if ($type !== null && !\in_array($type, ['HOME', 'WORK'])) {
            throw new \InvalidArgumentException(sprintf('The type of the Address must be "HOME" or "WORK", "%s" given.', $type));
        }

        $this->type = $type;
        $this->countryCode = $countryCode;
        $this->country = $country;
        $this->zip = $zip;
        $this->state = $state;
        $this->city = $city;
        $this->street = $street;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }
}
