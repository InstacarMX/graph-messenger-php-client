<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Interactive;

use Instacar\GraphMessengerApi\WhatsApp\Model\Action\ProductListAction;
use Instacar\GraphMessengerApi\WhatsApp\Model\Body;
use Instacar\GraphMessengerApi\WhatsApp\Model\Footer;
use Instacar\GraphMessengerApi\WhatsApp\Model\Header\TextHeader;

/**
 * @phpstan-extends Interactive<ProductListAction, TextHeader>
 */
final class InteractiveProductList extends Interactive
{
    public function __construct(ProductListAction $action, TextHeader $header, Body $body = null, Footer $footer = null)
    {
        parent::__construct($action, $header, $body, $footer);
    }

    public function getType(): string
    {
        return 'product_list';
    }
}
