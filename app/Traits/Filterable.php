<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $query)
    {
        if (request()->has('filter')) {
            foreach (request('filter') as $key => $value) {
                $query->where($key, $value);
            }
        }
    }
}
