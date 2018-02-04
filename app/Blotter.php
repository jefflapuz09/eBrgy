<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    protected $table = 'blotters';

    protected $fillable = [
        'complainant',
        'complainedResident',
        'officerCharge',
        'isActive'
    ];

    public function comRes(){
        return $this->belongsTo('App\Resident','complainedResident');
    }

    public function com(){
        return $this->belongsTo('App\Resident','complainant');
    }
}
