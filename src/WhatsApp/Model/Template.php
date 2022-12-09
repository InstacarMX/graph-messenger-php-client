<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Component\Component;

final class Template
{
    private string $name;

    private Language $language;

    /**
     * @var Collection<int, Component>
     */
    private Collection $components;

    public function __construct(string $name, Language $language)
    {
        $this->name = $name;
        $this->language = $language;
        $this->components = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return iterable<Component>
     */
    public function getComponents(): iterable
    {
        return $this->components;
    }

    public function addComponent(Component $component): self
    {
        $this->components->add($component);

        return $this;
    }

    public function removeComponent(Component $component): self
    {
        $this->components->removeElement($component);

        return $this;
    }
}
