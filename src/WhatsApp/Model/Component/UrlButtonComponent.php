<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Component;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\ButtonTextParameter;

final class UrlButtonComponent extends ButtonComponent
{
    /**
     * @phpstan-var Collection<int, ButtonTextParameter>
     */
    private Collection $parameters;

    public function __construct(int $index)
    {
        parent::__construct($index);

        $this->parameters = new ArrayCollection();
    }

    public function getSubType(): string
    {
        return 'url';
    }

    /**
     * @return iterable<ButtonTextParameter>
     */
    public function getParameters(): iterable
    {
        return $this->parameters;
    }

    public function addParameter(ButtonTextParameter $parameter): self
    {
        $this->parameters->add($parameter);

        return $this;
    }

    public function removeParameter(ButtonTextParameter $parameter): self
    {
        $this->parameters->removeElement($parameter);

        return $this;
    }
}
