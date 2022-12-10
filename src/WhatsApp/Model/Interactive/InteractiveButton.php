<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Interactive;

use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ButtonAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Body;
use Instacar\GraphMessengerApi\WhatsApp\Model\Footer;
use Instacar\GraphMessengerApi\WhatsApp\Model\Header\Header;

/**
 * @phpstan-extends Interactive<ButtonAction, Header>
 */
final class InteractiveButton extends Interactive
{
    public function __construct(ButtonAction $action, Body $body, Header $header = null, Footer $footer = null)
    {
        parent::__construct($action, $header, $body, $footer);
    }

    public function getType(): string
    {
        return 'button';
    }
}
