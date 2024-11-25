<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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

    public function scopeAccess(Builder $query)
    {
        if (Auth::user() && Auth::user()->role != "admin" && (isset(request('filter')['type']) && request('filter')['type'] == "subdistrict")) {
            $query->whereIn('id', json_decode(Auth::user()->access));
        }
    }
}
