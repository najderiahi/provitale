<?php

namespace App\QueryFilters;


class Category extends Filter {
    protected function applyFilter($builder) {
        if(is_array(request()->get($this->filterName))) {
            $category = \App\Category::whereIn('name', request()->get($this->filterName))->get();
            if($category) {
                return $builder->whereIn('category_id', $category->pluck('id'));
            } else {
                return $builder->whereRaw('0');
            }
        }
        return $builder->whereRaw('0');
    }
}
