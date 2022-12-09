<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Reaction;

final class ReactionMessage extends Message
{
    private Reaction $reaction;

    public function __construct(string $to, Reaction $reaction, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->reaction = $reaction;
    }

    public function getType(): string
    {
        return 'reaction';
    }

    public function getReaction(): Reaction
    {
        return $this->reaction;
    }
}
