<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model;

final class Organization
{
    private ?string $company;

    private ?string $department;

    private ?string $title;

    public function __construct(string $company = null, string $department = null, string $title = null)
    {
        if ($company === null && $department === null && $title === null) {
            throw new \LogicException('You must provide at least one of the following parameters: company, department, title');
        }

        $this->company = $company;
        $this->department = $department;
        $this->title = $title;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
