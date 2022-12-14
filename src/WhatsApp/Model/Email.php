<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Email
{
    private ?string $type;

    private string $email;

    public function __construct(string $email, ?string $type = null)
    {
        if (strlen($email) > 320) {
            throw new \InvalidArgumentException('The email address must be 320 characters or less');
        }
        if ($type !== null && !\in_array($type, ['HOME', 'WORK'])) {
            throw new \InvalidArgumentException(sprintf('The type of the Email must be "HOME" or "WORK", "%s" given.', $type));
        }

        $this->type = $type;
        $this->email = $email;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
