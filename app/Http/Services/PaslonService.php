<?php

namespace App\Http\Services;

use App\Models\Paslon;
use App\Models\Regionals;
use Spatie\QueryBuilder\QueryBuilder;

class PaslonService
{
    public function data()
    {
        $regionals = Paslon::select('paslons.*')
            ->selectRaw('(select FLOOR(RAND() * 200) + 2000) as total')
            ->selectRaw('(select 3055) as vote')
            // ->filter()
            ->get();

        return $regionals;
    }
}
