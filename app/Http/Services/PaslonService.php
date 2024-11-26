<?php

namespace App\Http\Services;

use App\Models\Paslon;
use Illuminate\Support\Facades\DB;

class PaslonService
{
    public function data()
    {
        $regionals = Paslon::select('paslons.*')
            ->selectRaw($this->queryRaw())
            ->selectRaw($this->totalPollstation())
            ->orderByDesc(DB::raw('total'))
            ->get();

        return $regionals;
    }

    public function queryRaw()
    {
        switch (request('view')) {
            case 'subdistrict':
                return '(select COALESCE(sum(v.vote),0) from votes v where v.paslonID = paslons.id) as total';
            case 'village':
                return '(select COALESCE(sum(v.vote),0) from votes v where v.paslonID = paslons.id and v.subdistrictID = "'.request('filter.parent_id').'") as total';
            case 'tps' || 'input-vote':
                return '(select COALESCE(sum(v.vote),0) from votes v where v.paslonID = paslons.id and v.subdistrictID = "'.request('subdistrictID').'" and v.villageID = "'.request('villageID').'") as total';
            default:
                return '(select COALESCE(sum(v.vote),0) from votes v where v.paslonID = paslons.id) as total';
        }
    }

    public function totalPollstation()
    {
        switch (request('view')) {
            case 'subdistrict':
                return '(select COALESCE(sum(v.vote),0) from votes v) as total_vote';
            case 'village':
                return '(select COALESCE(sum(v.vote),0) from votes v where v.subdistrictID = "'.request('filter.parent_id').'") as total_vote';
            case 'tps' || 'input-vote':
                return '(select COALESCE(sum(v.vote),0) from votes v where v.subdistrictID = "'.request('subdistrictID').'" and v.villageID = "'.request('villageID').'") as total_vote';
            default:
                return '(select COALESCE(sum(v.vote),0) from votes v) as total_vote';
        }
    }
}
