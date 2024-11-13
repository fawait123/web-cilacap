<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, $attributes = [])
    {
        if (request()->has('search')) {
            $query->where(function ($q) use ($attributes) {
                foreach ($attributes as $item) {
                    $q->orWhere($item, 'like', '%' . request('search') . '%');
                }
            });
        }
    }
}
