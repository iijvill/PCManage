<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; //Adminを認証に使うなら追加

class Admin extends Authenticatable//Adminを認証に使うなら　extendsをAuthenticatableに変更
{
    //
   public $timestamps = false;
   protected $primaryKey = 'admin_id';
}
