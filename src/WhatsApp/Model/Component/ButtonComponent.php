<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Component;

abstract class ButtonComponent extends Component
{
    private int $index;

    public function __construct(int $index)
    {
        $this->index = $index;
    }

    public function getType(): string
    {
        return 'button';
    }

    abstract public function getSubType(): string;

    public function getIndex(): int
    {
        return $this->index;
    }
}
