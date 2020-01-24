<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PcSpec extends Model
{
    protected $primaryKey = 'spec_id';
    protected $guarded = ['spec_id'];
    public $timestamps = false;
}
