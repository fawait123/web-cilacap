<?php

namespace App\Http\Services;

use App\Http\Resources\VoteCollection;
use App\Models\Pollstation;
use Spatie\QueryBuilder\QueryBuilder;

class PollstationService
{
    public function data()
    {
        $pollstations = Pollstation::select('pollstations.*')
            ->selectRaw($this->queryRaw())
            ->selectRaw('(select v.user_input from votes v where v.pollstationID = pollstations.id limit 1) as user_input')
            ->filter()
            ->with('document')
            ->get();

        return request('view') == "input-vote" ? new VoteCollection($pollstations) : $pollstations;
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

    public function vote()
    {
        $pollstations = Pollstation::select('pollstations.*')
            ->filter()
            ->get();

        return new VoteCollection($pollstations);
    }
}
