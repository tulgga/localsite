<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zar extends Model
{
    protected  $table='zar';

    public function Category(){
        return $this->hasOne(Zar_category::class, 'id','cat_id');
    }
}
