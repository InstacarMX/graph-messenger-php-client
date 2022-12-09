<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Template;

final class TemplateMessage extends Message
{
    private Template $template;

    public function __construct(string $to, Template $template, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->template = $template;
    }

    public function getType(): string
    {
        return 'template';
    }

    public function getTemplate(): Template
    {
        return $this->template;
    }
}
