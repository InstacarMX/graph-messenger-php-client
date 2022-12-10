<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Product
{
    private string $productRetailerId;

    public function __construct(string $productRetailerId)
    {
        $this->productRetailerId = $productRetailerId;
    }

    public function getProductRetailerId(): string
    {
        return $this->productRetailerId;
    }
}
