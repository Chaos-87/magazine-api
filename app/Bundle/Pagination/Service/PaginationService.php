<?php declare(strict_types=1);

namespace App\Bundle\Pagination\Service;

abstract class PaginationService
{
    private const NUMBER_0 = 0;
    private const NUMBER_1 = 1;

    /** @var int */
    private $itemsOfPage = 5;
    /** @var int */
    private $page = 1;

    /**
     * @param int|null $counter
     */
    public function setItemsOfPage(?int $counter)
    {
        if ($this->isPositive($counter)) {
            $this->itemsOfPage = $counter;
        }
    }

    /**
     * @param int|null $page
     */
    public function setPage(?int $page): void
    {
        if ($this->isPositive($page)) {
            $this->page = $page > $this->lastPage() ? $this->lastPage() : $page;
        }
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getCountItemsOfPage(): int
    {
        return $this->itemsOfPage;
    }

    /**
     * @return int
     */
    public function lastPage(): int
    {
        $lastPage = ceil($this->countResults() / $this->getCountItemsOfPage());
        return (int)$lastPage;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return ($this->getPage() - self::NUMBER_1) * $this->getCountItemsOfPage();
    }

    /**
     * @param int|null $value
     * @return bool
     */
    private function isPositive(?int $value): bool
    {
        return (!is_null($value) && $value > self::NUMBER_0);
    }

    /**
     * @return int
     */
    abstract public function countResults(): int;
}
