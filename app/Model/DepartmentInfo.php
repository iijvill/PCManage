<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DepartmentInfo extends Model
{
    protected $guarded = ['department_id'];

    protected $primaryKey = 'department_id';
    public $timestamps = false;
}
