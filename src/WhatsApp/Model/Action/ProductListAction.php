<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Action;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Section\ProductListSection;

final class ProductListAction extends Action
{
    private string $catalogId;

    /**
     * @var Collection<int, ProductListSection>
     */
    private Collection $sections;

    public function __construct(string $catalogId)
    {
        $this->catalogId = $catalogId;
        $this->sections = new ArrayCollection();
    }

    public function getCatalogId(): string
    {
        return $this->catalogId;
    }

    /**
     * @return iterable<ProductListSection>
     */
    public function getSections(): iterable
    {
        return $this->sections;
    }

    public function addSection(ProductListSection $section): self
    {
        $this->sections->add($section);

        return $this;
    }

    public function removeSection(ProductListSection $section): self
    {
        $this->sections->removeElement($section);

        return $this;
    }
}
