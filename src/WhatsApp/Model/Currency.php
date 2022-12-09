<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\SerializedName;

final class Currency
{
    private string $code;

    #[SerializedName('amount_1000')]
    private int $amount1000;

    private string $fallbackValue;

    public function __construct(string $code, float $amount, string $fallbackValue)
    {
        $this->code = $code;
        $this->amount1000 = (int) round($amount * 1000);
        $this->fallbackValue = $fallbackValue;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    #[Ignore]
    public function getAmount(): float
    {
        return round($this->amount1000 / 1000, 3);
    }

    public function getAmount1000(): int
    {
        return $this->amount1000;
    }

    public function getFallbackValue(): string
    {
        return $this->fallbackValue;
    }
}
