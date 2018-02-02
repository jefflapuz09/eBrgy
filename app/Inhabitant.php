<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inhabitant extends Model
{
    protected $table = 'inhabitants';

    protected $fillable = [
        'residentId',
        'householdId',
        'isActive'
    ];

    public function Resident(){
        return $this->belongsTo('App\Resident','residentId');
    }
}
