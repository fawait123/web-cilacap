<?php

namespace App\Http\Services;

use App\Models\Regionals;
use Spatie\QueryBuilder\QueryBuilder;

class RegionalService
{
    public function data()
    {
        $regionals = Regionals::select('regionals.*')
            ->selectRaw('(select FLOOR(RAND() * 200) + 2000) as total')
            ->selectRaw('(select 3055) as vote')
            ->filter()
            ->get();

        return $regionals;
    }
}
