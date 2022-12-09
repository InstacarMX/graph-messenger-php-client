<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Name
{
    private ?string $firstName;

    private ?string $middleName;

    private ?string $lastName;

    private ?string $suffix;

    private ?string $prefix;

    public function __construct(
        string $firstName = null,
        string $middleName = null,
        string $lastName = null,
        string $prefix = null,
        string $suffix = null,
    ) {
        if ($firstName === null && $middleName === null && $lastName === null && $suffix === null && $prefix === null) {
            throw new \LogicException('You must provide at least one of the following parameters: firstName, lastName, middleName, suffix, prefix');
        }

        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }

    public function getFormattedName(): string
    {
        $formattedName = '';
        $firstName = $this->firstName;
        $middleName = $this->middleName;
        $lastName = $this->lastName;
        $suffix = $this->suffix;
        $prefix = $this->prefix;

        if ($prefix !== null) {
            $formattedName .= $prefix . ' ';
        }
        if ($firstName !== null) {
            $formattedName .= $firstName . ' ';
        }
        if ($middleName !== null) {
            $formattedName .= $middleName . ' ';
        }
        if ($lastName !== null) {
            $formattedName .= $lastName . ' ';
        }
        if ($suffix !== null) {
            $formattedName .= $suffix . ' ';
        }

        return rtrim($formattedName);
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }
}
