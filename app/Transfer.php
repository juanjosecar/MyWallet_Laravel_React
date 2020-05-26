<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
   public function wallet(){
       return $this->belongsTo('App\Wallet'); //(NO s) En esta relacion decimos que una transferencia pertenece a una sola wallet , 
   }
}
