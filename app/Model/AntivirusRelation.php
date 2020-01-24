<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AntivirusRelation extends Model
{
    //
    protected $guarded = ['antirelation_id'];
    public $timestamps = false;
    protected $primaryKey = 'antirelation_id';
}
