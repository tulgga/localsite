<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table="workers";

    protected $fillable = [
        'workerId',
        'lastname',
        'author_id',
        'com_id',
        'dep_id',
        'app_id',
        'work_duty',
        'com_name',
        'dep_name',
        'app_name',
        'system_name',
        'photo',
        'work_mail',
        'work_phone',
        'code',
        'ergonomist',
        'date',
    ];
}
