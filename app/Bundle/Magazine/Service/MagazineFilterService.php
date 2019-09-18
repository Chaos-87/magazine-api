<?php declare(strict_types=1);

namespace App\Bundle\Magazine\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait MagazineFilterService
{
    /** @var array  */
    private $filters = [];

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function build(Builder $builder): Builder
    {
        if (empty($this->filters)) {
            return $builder;
        }

        foreach ($this->filters as $column => $value) {
            switch ($column) {
                case 'publisher_id':
                    $builder->whereIn($column, $value);
                    break;
                case 'name':
                    $builder->where($column, 'like', $value, 'and');
                    break;
            }
        }
        return $builder;
    }

    /**
     * @param Request $request
     */
    public function setParameters(Request $request): void
    {
        if ($request->has('filters') && is_array($filters = $request->input('filters'))) {
            foreach ($filters as $filter => $value) {
                switch ($filter) {
                    case 'publishers':
                        if (is_string($value) || is_int($value)) {
                            $idPublisher = (int)$value;
                            ($idPublisher > 0) ? $value[] = $idPublisher : null;
                        }
                        if (is_array($value)) {
                            $this->filters['publisher_id'] = $value;
                        }
                        break;
                    case 'name':
                        $this->filters['name'] = '%' . $value . '%';
                        break;
                }
            }
        }

    }
}
