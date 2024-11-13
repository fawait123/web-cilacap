<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use App\Traits\Searchable;

class Regionals extends Model
{
    use Filterable, Searchable;
    protected $guarded = ['id'];
}
