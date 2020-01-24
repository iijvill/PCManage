<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StorageType extends Model
{
    protected $guarded = ['storage_id'];
    public $timestamps = false;
    protected $primaryKey = 'storage_id';
}
