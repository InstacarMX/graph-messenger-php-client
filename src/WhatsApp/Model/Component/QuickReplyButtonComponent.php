<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Component;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Parameter\ButtonPayloadParameter;

final class QuickReplyButtonComponent extends ButtonComponent
{
    /**
     * @var Collection<int, ButtonPayloadParameter>
     */
    private Collection $parameters;

    public function __construct(int $index)
    {
        parent::__construct($index);

        $this->parameters = new ArrayCollection();
    }

    public function getSubType(): string
    {
        return 'quick_reply';
    }

    /**
     * @return iterable<ButtonPayloadParameter>
     */
    public function getParameters(): iterable
    {
        return $this->parameters;
    }

    public function addParameter(ButtonPayloadParameter $parameter): self
    {
        $this->parameters->add($parameter);

        return $this;
    }

    public function removeParameter(ButtonPayloadParameter $parameter): self
    {
        $this->parameters->removeElement($parameter);

        return $this;
    }
}
