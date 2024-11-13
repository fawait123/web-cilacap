<?php

namespace App\Http\Services;

use App\Models\Pollstation;
use Spatie\QueryBuilder\QueryBuilder;

class PollstationService
{
    public function data()
    {
        $pollstations = Pollstation::select('pollstations.*')
            ->selectRaw($this->queryRaw())
            ->filter()
            ->get();

        return $pollstations;
    }

    public function queryRaw()
    {
        switch (request('view')) {
            case 'tps':
                return '(select COALESCE(sum(v.vote),0) from votes v where v.pollstationID = pollstations.id and v.villageID = pollstations.villageID and v.subdistrictID = pollstations.subdistrictID) total';

            default:
                return '(select 3055) as total';
        }
    }
}
