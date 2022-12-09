<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp;

use Instacar\GraphMessengerApi\Exception\GraphException;
use Instacar\GraphMessengerApi\GraphClient;
use Instacar\GraphMessengerApi\WhatsApp\Model\Message\Message;
use Instacar\GraphMessengerApi\WhatsApp\Response\MessageResponse;
use Psr\Http\Client\ClientExceptionInterface;

final class WhatsAppClient extends GraphClient
{
    /**
     * @throws ClientExceptionInterface
     * @throws GraphException
     */
    public function sendMessage(string $identifier, Message $message): MessageResponse
    {
        return $this->sendJsonRequest("$identifier/messages", MessageResponse::class, 'POST', payload: $message);
    }
}
