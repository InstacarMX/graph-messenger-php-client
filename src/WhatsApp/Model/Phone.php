<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Phone
{
    private ?string $type;

    private ?string $phone;

    private ?string $waId;

    public function __construct(string $phone = null, string $waId = null, string $type = null)
    {
        if ($phone === null && $waId === null) {
            throw new \LogicException('You must provide at least one of the following parameters: phone, waId');
        }
        if ($type !== null && !\in_array($type, ['CELL', 'MAIN', 'IPHONE', 'HOME', 'WORK'])) {
            throw new \InvalidArgumentException(sprintf('The type of the Phone must be "CELL", "MAIN", "IPHONE", "HOME" or "WORK", "%s" given.', $type));
        }

        $this->type = $type;
        $this->phone = $phone;
        $this->waId = $waId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getWaId(): ?string
    {
        return $this->waId;
    }
}
