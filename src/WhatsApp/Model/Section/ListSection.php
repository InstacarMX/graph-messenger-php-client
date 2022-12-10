<?php

declare(strict_types=1);

namespace Instacar\GraphMessengerApi\WhatsApp\Model\Section;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Instacar\GraphMessengerApi\WhatsApp\Model\Row;

final class ListSection extends Section
{
    /**
     * @var Collection<int, Row>
     */
    private Collection $rows;

    public function __construct(string $title = null)
    {
        parent::__construct($title);

        $this->rows = new ArrayCollection();
    }

    /**
     * @return iterable<Row>
     */
    public function getRows(): iterable
    {
        return $this->rows;
    }

    public function addRow(Row $row): self
    {
        $this->rows->add($row);

        return $this;
    }

    public function removeRow(Row $row): self
    {
        $this->rows->removeElement($row);

        return $this;
    }
}
