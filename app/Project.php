<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'projectName',
        'projectDev',
        'description',
        'officerCharge',
        'dateStarted',
        'dateEnded',
        'status',
        'isActive'
    ];
}
