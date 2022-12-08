<?php

namespace Instacar\GraphMessengerApi\Model;

final class Error
{
    private int $code;

    private ?int $errorSubcode;

    private string $message;

    private ?string $details;

    private string $type;

    private string $fbtraceId;

    public function __construct(
        int $code,
        string $message,
        string $type,
        string $fbtraceId,
        int $errorSubcode = null,
        string $details = null,
    ) {
        $this->code = $code;
        $this->errorSubcode = $errorSubcode;
        $this->message = $message;
        $this->details = $details;
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
        return $this->details;
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