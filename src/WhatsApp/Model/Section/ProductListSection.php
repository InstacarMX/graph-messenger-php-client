<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Section;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Product;

final class ProductListSection extends Section
{
    /**
     * @var Collection<int, Product>
     */
    public Collection $productItems;

    public function __construct(string $title = null)
    {
        parent::__construct($title);

        $this->productItems = new ArrayCollection();
    }

    /**
     * @return iterable<Product>
     */
    public function getProductItems(): iterable
    {
        return $this->productItems;
    }

    public function addProductItem(Product $product): self
    {
        $this->productItems->add($product);

        return $this;
    }

    public function removeProductItem(Product $product): self
    {
        $this->productItems->removeElement($product);

        return $this;
    }
}
