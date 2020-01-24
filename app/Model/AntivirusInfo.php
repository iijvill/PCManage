<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AntivirusInfo extends Model
{
    protected $guarded = ['antivirus_id'];
    public $timestamps = false;
    protected $primaryKey = 'antivirus_id';
}
