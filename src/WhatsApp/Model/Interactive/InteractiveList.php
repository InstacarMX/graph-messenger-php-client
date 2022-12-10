<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Interactive;

use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ListAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Body;
use Instacar\GraphMessengerApi\WhatsApp\Model\Footer;
use Instacar\GraphMessengerApi\WhatsApp\Model\Header\TextHeader;

/**
 * @phpstan-extends Interactive<ListAction, TextHeader>
 */
final class InteractiveList extends Interactive
{
    public function __construct(ListAction $action, Body $body, TextHeader $header = null, Footer $footer = null)
    {
        parent::__construct($action, $header, $body, $footer);
    }

    public function getType(): string
    {
        return 'list';
    }
}
