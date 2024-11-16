<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Pollstation extends Model
{
    use Filterable;
    protected $guarded = ['id'];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function document(): MorphOne
    {
        return $this->morphOne(Document::class, 'documentable');
    }
}
