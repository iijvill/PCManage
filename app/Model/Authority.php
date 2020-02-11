<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    protected $primaryKey = 'auth_id';

    protected $guard = ['auth_id'];
}
