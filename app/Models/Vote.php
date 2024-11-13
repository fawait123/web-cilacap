<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $guarded = ['id'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Regionals::class, 'provinceID');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(Regionals::class, 'districtID');
    }

    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(Regionals::class, 'subdistrictID');
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Regionals::class, 'villageID');
    }

    public function pollstation(): BelongsTo
    {
        return $this->belongsTo(Pollstation::class, 'pollstationID');
    }

    public function paslon(): BelongsTo
    {
        return $this->belongsTo(Paslon::class, 'paslonID');
    }
}
