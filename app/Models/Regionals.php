<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;

class Regionals extends Model
{
    use Filterable;
    protected $guarded = ['id'];
}
