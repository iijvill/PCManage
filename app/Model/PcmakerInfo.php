<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PcmakerInfo extends Model
{
    protected $guarded = ['pcmaker_id'];
    public $timestamps = false;
    protected $primaryKey = 'pcmaker_id';
}
