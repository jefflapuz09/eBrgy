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
        'isDerogatory',
        'contactNumber',
        'created_at'
    ];

    public function Parents(){
        return $this->hasMany('App\parentModel','residentId');
    }

    public function Officer(){
        return $this->hasMany('App\Officer','officerId');
    }

    public function Voter(){
        return $this->hasMany('App\Voter','residentId');
    }
}
