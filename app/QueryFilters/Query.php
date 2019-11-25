<?php

namespace App\QueryFilters;


class Query extends Filter {
    protected function applyFilter($builder) {
        if(request()->get($this->filterName) != '') {
            return $builder->where('description', 'like', "%".request()->get($this->filterName)."%");
        }
        return $builder;
    }
}
