<?php

namespace App\QueryFilters;

class Sort extends Filter {
    protected function applyFilter($builder) {
        return request()->get($this->filterName) == 'oldest' ? $builder->orderBy('created_at') : $builder->orderBy('created_at', 'DESC');
    }
}
