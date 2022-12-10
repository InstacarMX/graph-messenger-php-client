<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Interactive;

use Instacar\GraphMessengerApi\WhatsApp\Model\Action\Action;
use Instacar\GraphMessengerApi\WhatsApp\Model\Body;
use Instacar\GraphMessengerApi\WhatsApp\Model\Footer;
use Instacar\GraphMessengerApi\WhatsApp\Model\Header\Header;

/**
 * @phpstan-template TAction of Action
 * @phpstan-template THeader of Header
 */
abstract class Interactive
{
    /**
     * @phpstan-var TAction
     */
    private Action $action;

    /**
     * @phpstan-var THeader
     */
    private ?Header $header;

    private ?Body $body;

    private ?Footer $footer;

    /**
     * @phpstan-param TAction $action
     * @phpstan-param THeader $header
     */
    public function __construct(Action $action, Header $header = null, Body $body = null, Footer $footer = null)
    {
        $this->action = $action;
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
    }

    abstract public function getType(): string;

    /**
     * @phpstan-return TAction
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @phpstan-return THeader
     */
    public function getHeader(): ?Header
    {
        return $this->header;
    }

    public function getBody(): ?Body
    {
        return $this->body;
    }

    public function getFooter(): ?Footer
    {
        return $this->footer;
    }
}
