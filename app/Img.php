<?php

namespace App;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{

    public static function single($request, $dir){
        if(!$request->hasFile('image')){
            return null;
        }
        $img = $request->image->store($dir);
        return $img;
    }

    public static function upload($request){

        if(!$request->hasFile('image')){
            return null;
        }

        $img = $request->image->store('images');

        $save = Image::make('uploads/'.$img);

        $save->resize(250, 156);
        $save->save(str_replace('images/', 'small/', 'uploads/'.$img));

        $save->resize(370, 250);
        $save->save(str_replace('images/', 'medium/', 'uploads/'.$img));

        $save->resize(750, 500);
        $save->save(str_replace('images/', 'large/', 'uploads/'.$img));

        $save->resize(1200, 750);
        $save->save(str_replace('images/', 'full/', 'uploads/'.$img));

        return $img;
    }
}
