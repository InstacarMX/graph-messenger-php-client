<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class MessageResponse
{
    private string $messagingProduct;

    /**
     * @var Collection<int, array{"input": string, "wa_id": string}>
     */
    private Collection $contacts;

    /**
     * @var Collection<int, array{"id": string}>
     */
    private Collection $messages;

    public function __construct(string $messagingProduct)
    {
        $this->messagingProduct = $messagingProduct;
        $this->contacts = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getMessagingProduct(): string
    {
        return $this->messagingProduct;
    }

    /**
     * @phpstan-return iterable<array{"input": string, "wa_id": string}>
     */
    public function getContacts(): iterable
    {
        return $this->contacts;
    }

    /**
     * @phpstan-param array{"input": string, "wa_id": string} $contact
     */
    public function addContact(array $contact): self
    {
        $this->contacts->add($contact);

        return $this;
    }

    /**
     * @phpstan-param array{"input": string, "wa_id": string} $contact
     */
    public function removeContact(array $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @phpstan-return iterable<array{"id": string}>
     */
    public function getMessages(): iterable
    {
        return $this->messages;
    }

    /**
     * @phpstan-param array{"id": string} $message
     */
    public function addMessage(array $message): self
    {
        $this->messages->add($message);

        return $this;
    }

    /**
     * @phpstan-param array{"id": string} $message
     */
    public function removeMessage(array $message): self
    {
        $this->messages->removeElement($message);

        return $this;
    }
}
