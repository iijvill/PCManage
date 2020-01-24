<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    protected $guarded = ['employee_id'];

    protected $primaryKey = 'employee_id';
}
