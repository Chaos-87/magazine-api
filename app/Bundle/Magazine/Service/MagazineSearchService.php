<?php declare(strict_types=1);

namespace App\Bundle\Magazine\Service;

use App\Bundle\Pagination\Service\PaginationService;
use App\Magazine;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MagazineSearchService extends PaginationService
{
    use MagazineFilterService;

    /** @var Builder */
    private $magazine;

    public function __construct(
        Magazine $magazine
    ) {
        $this->magazine = $magazine->newQuery()->with('publisher');
    }

    public function addFilterParameters()
    {
        $this->magazine = $this->build($this->magazine);
    }

    /**
     * @return int
     */
    public function countResults(): int
    {
        return $this->magazine->count();
    }

    /**
     * @return Builder[]|Collection
     */
    public function get()
    {
        $this->magazine->offset($this->getOffset())->limit($this->getCountItemsOfPage())->orderBy('id');
        return $this->magazine->get();
    }
}
