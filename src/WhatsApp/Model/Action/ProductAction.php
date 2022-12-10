<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Action;

final class ProductAction extends Action
{
    private string $catalogId;

    private string $productRetailerId;

    public function __construct(string $catalogId, string $productRetailerId)
    {
        $this->catalogId = $catalogId;
        $this->productRetailerId = $productRetailerId;
    }

    public function getCatalogId(): string
    {
        return $this->catalogId;
    }

    public function getProductRetailerId(): string
    {
        return $this->productRetailerId;
    }
}
