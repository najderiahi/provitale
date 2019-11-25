<?php
/**
 * Created by IntelliJ IDEA.
 * User: emmanuel
 * Date: 21/11/19
 * Time: 14:37
 */

namespace App\QueryFilters;


use Illuminate\Support\Str;

abstract class Filter
{

    public $filterName;

    public function __construct()
    {
        $this->filterName = Str::snake(class_basename($this));
    }

    public function handle($request, \Closure $next) {
        if(!request()->has($this->filterName)) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    protected abstract function applyFilter($builder);
}
