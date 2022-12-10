<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Action;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Button\Button;

final class ButtonAction extends Action
{
    /**
     * @var Collection<int, Button>
     */
    private Collection $buttons;

    public function __construct()
    {
        $this->buttons = new ArrayCollection();
    }

    /**
     * @return iterable<Button>
     */
    public function getButtons(): iterable
    {
        return $this->buttons;
    }

    public function addButton(Button $button): self
    {
        $this->buttons->add($button);

        return $this;
    }

    public function removeButton(Button $button): self
    {
        $this->buttons->removeElement($button);

        return $this;
    }
}
