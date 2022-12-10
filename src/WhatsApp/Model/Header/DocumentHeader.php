<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Header;

use Instacar\GraphMessengerApi\WhatsApp\Model\Media\DocumentMedia;

final class DocumentHeader extends Header
{
    private DocumentMedia $document;

    public function __construct(DocumentMedia $document)
    {
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
