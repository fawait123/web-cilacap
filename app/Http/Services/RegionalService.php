<?php

namespace App\Http\Services;

use App\Models\Regionals;

class RegionalService
{
    public function data()
    {
        $regionals = Regionals::select('regionals.*')
            ->selectRaw($this->queryRaw())
            ->selectRaw($this->totalPollstation())
            ->filter()
            ->access()
            ->search(['name'])
            ->paginate(
                10,
                ['*'],
                'pagination'
            )->withQueryString();

        return $regionals;
    }

    public function excelData()
    {
        $regionals = Regionals::select('regionals.*')
            ->selectRaw('(select count(distinct v.pollstationID) from votes v where v.subdistrictID = regionals.id) as total')
            ->selectRaw('(select count(distinct tps.id) from pollstations tps where tps.subdistrictID = regionals.id) as total_tps')
            ->selectRaw("(select COALESCE(sum(v.vote),0) from votes v where v.subdistrictID = regionals.id) vote")
            ->access()
            ->where('type', 'subdistrict')
            ->get();

        return $regionals;
    }

    public function queryRaw()
    {
        switch (request('view')) {
            case 'subdistrict':
                return '(select count(distinct v.pollstationID) from votes v where v.subdistrictID = regionals.id and v.vote != 0) as total';
            case 'village':
                return '(select count(distinct v.pollstationID) from votes v where v.villageID = regionals.id and v.subdistrictID = regionals.parent_id and v.vote != 0) as total';

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
            ->selectRaw('(select count(distinct v.pollstationID) from votes v where v.subdistrictID = regionals.id and v.vote != 0) total')
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
