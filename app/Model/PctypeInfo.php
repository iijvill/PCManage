<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PctypeInfo extends Model
{
    protected $guarded = ['pctype_id'];
    public $timestamps = false;
    protected $primaryKey = 'pctype_id';
}
