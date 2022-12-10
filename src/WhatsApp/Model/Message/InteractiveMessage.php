<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Interactive\Interactive;

/**
 * @phpstan-template TInteractive of Interactive
 */
final class InteractiveMessage extends Message
{
    /**
     * @phpstan-var TInteractive
     */
    private Interactive $interactive;

    /**
     * @phpstan-param TInteractive $interactive
     */
    public function __construct(string $to, Interactive $interactive)
    {
        parent::__construct($to);

        $this->interactive = $interactive;
    }

    public function getType(): string
    {
        return 'interactive';
    }

    /**
     * @phpstan-return TInteractive
     */
    public function getInteractive(): Interactive
    {
        return $this->interactive;
    }
}
