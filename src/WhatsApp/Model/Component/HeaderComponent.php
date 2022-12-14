<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Component;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\Parameter;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\TextParameter;

final class HeaderComponent extends Component
{
    /**
     * @var Collection<int, Parameter>
     */
    private Collection $parameters;

    public function __construct()
    {
        $this->parameters = new ArrayCollection();
    }

    public function getType(): string
    {
        return 'header';
    }

    /**
     * @return iterable<Parameter>
     */
    public function getParameters(): iterable
    {
        return $this->parameters;
    }

    public function addParameter(Parameter $parameter): self
    {
        if ($parameter instanceof TextParameter && \strlen($parameter->getText()) > 60) {
            throw new \InvalidArgumentException('The text must be 60 characters or less');
        }

        $this->parameters->add($parameter);

        return $this;
    }

    public function removeParameter(Parameter $parameter): self
    {
        $this->parameters->removeElement($parameter);

        return $this;
    }
}
