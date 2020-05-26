<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function transfers(){

        return $this->hasMany('App\Transfer'); //En esta relacion decimos que una wallet puede tener muchas transferencias.
    }
}
