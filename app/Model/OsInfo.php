<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OsInfo extends Model
{
    protected $guarded = ['os_id'];
    public $timestamps = false;
    protected $primaryKey = 'os_id';
}
