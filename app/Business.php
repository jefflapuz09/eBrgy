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
        'isActive',
        'created_at'
    ];

    public function Resident()
    {
       return $this->belongsTo('App\Resident','residentId');
    }
}
