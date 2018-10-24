<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';

    public static function menuType($type, $type_id,  $link){

        //link
        if($type==0){return $link;}

        //news-single
        if($type==1){return '/news/'.$type_id;}

        //news category
        if($type==2){return '/category/'.$type_id;}

        //page
        if($type==3){return '/p/'.$type_id;}

        //file catgeory
        if($type==4){return '/files/'.$type_id;}

        //file
        if($type==5){return'/file/'.$type_id;}

        //link category
        if($type==6){return '/link/'.$type_id;}

        return $link;
    }
}
