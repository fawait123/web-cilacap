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
            ->selectRaw($this->queryRaw())
            ->filter()
            ->get();

        return $pollstations;
    }

    public function queryRaw()
    {
        switch (request('view')) {
            case 'tps':
                return '(select sum(v.vote) from votes v where v.pollstationID = pollstations.id and v.villageID = pollstations.villageID and v.subdistrictID = pollstations.subdistrictID) total';

            default:
                return '(select 3055) as total';
        }
    }
}
