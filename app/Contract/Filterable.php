<?php

namespace App\Contract;

use Illuminate\Pipeline\Pipeline;

trait Filterable {

    public static function filterAll() {
        return app(Pipeline::class)
            ->send(static::query())
            ->through(static::getFilters())
            ->thenReturn();
    }

    protected static function getFilters() {
        return [];
    }

}
