<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stockconfirmcheck extends Model
{
    protected $guarded = ['stockconfirm_id'];
    public $timestamps = false;
    protected $primaryKey = 'stockconfirm_id';

}
