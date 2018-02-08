<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'residentId',
        'name',
        'street',
        'brgy',
        'city',
        'description',
        'isActive'
    ];

    public function Resident()
    {
       return $this->belongsTo('App\Resident','residentId');
    }
}
