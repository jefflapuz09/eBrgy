<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parentModel extends Model
{
    protected $table = 'parents';

    protected $fillable = [
        'residentId',
        'motherFirstName',
        'motherMiddleName',
        'motherLastName',
        'fatherFirstName',
        'fatherMiddleName',
        'fatherLastName',
        'isActive',
    ];
}
