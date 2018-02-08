<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $table = 'voters';

    protected $fillable = [
        'residentId',
        'voterId',
        'precintNo',
        'isActive'
    ];
}
