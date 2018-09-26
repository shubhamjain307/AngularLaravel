<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class train extends Model
{
    protected $fillable = [
        'source', 'destination','price',
    ];
}
