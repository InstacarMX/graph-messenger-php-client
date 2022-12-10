<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Interactive;

use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ProductAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Body;
use Instacar\GraphMessengerApi\WhatsApp\Model\Footer;

/**
 * @phpstan-extends Interactive<ProductAction, never>
 */
final class InteractiveProduct extends Interactive
{
    public function __construct(ProductAction $action, Body $body = null, Footer $footer = null)
    {
        parent::__construct($action, null, $body, $footer);
    }

    public function getType(): string
    {
        return 'product';
    }
}
