<?php

namespace App\Http\Services;

use App\Models\Pollstation;
use Spatie\QueryBuilder\QueryBuilder;

class PollstationService
{
    public function data()
    {
        $pollstations = Pollstation::select('pollstations.*')
            ->selectRaw('(select FLOOR(RAND() * 200) + 2000) as total')
            ->selectRaw('(select 3055) as vote')
            ->filter()
            ->get();

        return $pollstations;
    }
}
