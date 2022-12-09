<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

final class Contact
{
    private Name $name;

    #[Context(context: [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private ?\DateTimeInterface $birthday;

    private ?Organization $org;

    /**
     * @var Collection<int, Address>
     */
    private Collection $addresses;

    /**
     * @var Collection<int, Email>
     */
    private Collection $emails;

    /**
     * @var Collection<int, Phone>
     */
    private Collection $phones;

    /**
     * @var Collection<int, Url>
     */
    private Collection $urls;

    public function __construct(Name $name, \DateTimeInterface $birthday = null, ?Organization $org = null)
    {
        $this->name = $name;
        $this->birthday = $birthday;
        $this->org = $org;
        $this->addresses = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->urls = new ArrayCollection();
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function getOrg(): ?Organization
    {
        return $this->org;
    }

    /**
     * @return iterable<Address>
     */
    public function getAddresses(): iterable
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        $this->addresses->add($address);

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        $this->addresses->removeElement($address);

        return $this;
    }

    /**
     * @return iterable<Email>
     */
    public function getEmails(): iterable
    {
        return $this->emails;
    }

    public function addEmail(Email $email): self
    {
        $this->emails->add($email);

        return $this;
    }

    public function removeEmail(Email $email): self
    {
        $this->emails->removeElement($email);

        return $this;
    }

    /**
     * @return iterable<Phone>
     */
    public function getPhones(): iterable
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): self
    {
        $this->phones->add($phone);

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        $this->phones->removeElement($phone);

        return $this;
    }

    /**
     * @return iterable<Url>
     */
    public function getUrls(): iterable
    {
        return $this->urls;
    }

    public function addUrl(Url $url): self
    {
        $this->urls->add($url);

        return $this;
    }

    public function removeUrl(Url $url): self
    {
        $this->urls->removeElement($url);

        return $this;
    }
}
