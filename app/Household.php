<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $table = 'households';

    protected $fillable = [
        'id',
        'street',
        'brgy',
        'city',
        'isActive'
    ];

    public function Inhabitants(){
        return $this->hasMany('App\Inhabitant','householdId');
    }
}
