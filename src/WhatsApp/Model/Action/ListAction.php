<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Action;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Section\ListSection;

final class ListAction extends Action
{
    private string $button;

    /**
     * @var Collection<int, ListSection>
     */
    private Collection $sections;

    public function __construct(string $button)
    {
        if (strlen($button) > 20) {
            throw new \InvalidArgumentException('The button content of the ListAction must be 20 characters or less');
        }

        $this->button = $button;
        $this->sections = new ArrayCollection();
    }

    public function getButton(): string
    {
        return $this->button;
    }

    /**
     * @return iterable<ListSection>
     */
    public function getSections(): iterable
    {
        return $this->sections;
    }

    public function addSection(ListSection $section): self
    {
        $this->sections->add($section);

        return $this;
    }

    public function removeSection(ListSection $section): self
    {
        $this->sections->removeElement($section);

        return $this;
    }
}
