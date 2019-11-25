<?php

namespace App\QueryFilters;


class Query extends Filter {
    protected function applyFilter($builder) {
        return $builder->where('description', 'like', "%".request()->get($this->filterName)."%");
    }
}
