<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CpuInfo extends Model
{
    protected $guarded = ['cpu_id'];
    public $timestamps = false;
    protected $primaryKey = 'cpu_id';
}
