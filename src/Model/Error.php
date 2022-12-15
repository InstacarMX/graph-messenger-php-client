<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;

final class Error
{
    private int $code;

    private ?int $errorSubcode;

    private string $message;

    /**
     * @phpstan-var array{"messaging_product": string, "details": string}|null
     */
    #[SerializedName('error_data')]
    private ?array $data;

    private string $type;

    private string $fbtraceId;

    /**
     * @phpstan-param array{"messaging_product": string, "details": string}|null $data
     */
    public function __construct(
        int $code,
        string $message,
        string $type,
        string $fbtraceId,
        int $errorSubcode = null,
        array $data = null,
    ) {
        $this->code = $code;
        $this->errorSubcode = $errorSubcode;
        $this->message = $message;
        $this->data = $data;
        $this->type = $type;
        $this->fbtraceId = $fbtraceId;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getErrorSubcode(): ?int
    {
        return $this->errorSubcode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDetails(): ?string
    {
        return $this->data['details'] ?? null;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getFbtraceId(): string
    {
        return $this->fbtraceId;
    }
}
