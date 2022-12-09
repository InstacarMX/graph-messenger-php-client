<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Parameter;

use Instacar\GraphMessengerApi\WhatsApp\Model\Media\DocumentMedia;

final class DocumentParameter extends Parameter
{
    private DocumentMedia $document;

    public function __construct(DocumentMedia $document)
    {
        $this->document = $document;
    }

    public function getDocument(): DocumentMedia
    {
        return $this->document;
    }
}
