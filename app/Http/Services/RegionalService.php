<?php

namespace App\Http\Services;

use App\Models\Regionals;
use Spatie\QueryBuilder\QueryBuilder;

class RegionalService
{
    public function data()
    {
        $regionals = Regionals::select('regionals.*')
            ->selectRaw($this->queryRaw())
            ->selectRaw($this->totalPollstation())
            ->filter()
            ->get();

        return $regionals;
    }

    public function queryRaw()
    {
        switch (request('view')) {
            case 'subdistrict':
                return '(select count(distinct v.pollstationID) from votes v where v.subdistrictID = regionals.id) as total';
            case 'village':
                return '(select count(distinct v.pollstationID) from votes v where v.villageID = regionals.id and v.subdistrictID = regionals.parent_id) as total';

            default:
                return '(select "0" ) as total';
        }
    }

    public function totalPollstation()
    {
        switch (request('view')) {
            case 'subdistrict':
                return '(select count(distinct tps.id) from pollstations tps where tps.subdistrictID = regionals.id) as total_tps';
            case 'village':
                return '(select count(distinct tps.id) from pollstations tps where tps.villageID = regionals.id and tps.subdistrictID = regionals.parent_id) as total_tps';
            default:
                # code...
                return '(select "0" ) as total_tps';
        }
    }

    public function subDistrict()
    {
        $regionals = Regionals::select('regionals.*')
            ->selectRaw('(select count(distinct v.pollstationID) from votes v where v.subdistrictID = regionals.id) total')
            ->where('type', 'subdistrict')
            ->get();

        return $regionals;
    }

    public function dataSubDistrictOnly()
    {
        $regionals = Regionals::select('regionals.*')
            ->where('type', 'subdistrict')
            ->get();

        return $regionals;
    }
}
