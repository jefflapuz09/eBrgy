<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'officers';

    protected $fillable = [
        'residentId',
        'position',
        'isActive'
    ];

    public function Resident(){
        return $this->belongsTo('App\Resident','residentId');
    }
}
