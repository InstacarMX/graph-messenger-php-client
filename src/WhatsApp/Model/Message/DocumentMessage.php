<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Instacar\GraphMessengerApi\WhatsApp\Model\Context;
use Instacar\GraphMessengerApi\WhatsApp\Model\Media\DocumentMedia;

final class DocumentMessage extends Message
{
    private DocumentMedia $document;

    public function __construct(string $to, DocumentMedia $document, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->document = $document;
    }

    public function getType(): string
    {
        return 'document';
    }

    public function getDocument(): DocumentMedia
    {
        return $this->document;
    }
}
