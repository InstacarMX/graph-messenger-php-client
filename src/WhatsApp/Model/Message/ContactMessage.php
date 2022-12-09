<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Message;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Contact;
use Instacar\GraphMessengerApi\WhatsApp\Model\Context;

final class ContactMessage extends Message
{
    /**
     * @phpstan-var Collection<int, Contact>
     */
    private Collection $contacts;

    public function __construct(string $to, Context $context = null)
    {
        parent::__construct($to, $context);

        $this->contacts = new ArrayCollection();
    }

    public function getType(): string
    {
        return 'contacts';
    }

    /**
     * @phpstan-return iterable<Contact>
     */
    public function getContacts(): iterable
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        $this->contacts->add($contact);

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }
}
