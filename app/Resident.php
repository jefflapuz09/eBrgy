<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'province',
        'street',
        'brgy',
        'city',
        'citizenship',
        'religion',
        'dateCitizen',
        'orderApproval',
        'occupation',
        'tinNo',
        'isUnpleasant',
        'gender',
        'birthdate',
        'birthPlace',
        'civilStatus',
        'periodResidence',
        'image',
        'isActive',
        'isRegistered',
        'isDerogatory'
    ];

    public function Parents(){
        return $this->hasMany('App\parentModel','residentId');
    }
}
