<?php

namespace App;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Img extends Model
{

    public static function file_delete($file){
        Storage::delete($file);
    }



    public static function single($request, $dir){
        if(!$request->hasFile('image')){
            return null;
        }
        $img = $request->image->store($dir);
        return $img;
    }

    public static function file($request, $dir){
        if(!$request->hasFile('file')){
            return null;
        }
        $file = $request->file('file')->store($dir);
        return $file;
    }

    public static function deleteImg($file){
        Storage::delete($file);
        Storage::delete(str_replace('images/', 'small/', $file));
        Storage::delete(str_replace('images/', 'medium/', $file));
        Storage::delete(str_replace('images/', 'large/', $file));
        Storage::delete(str_replace('images/', 'full/', $file));
    }

    public static function upload($request){

        if(!$request->hasFile('image')){
            return null;
        }

        $img = $request->image->store('images');




        $save = Image::make('uploads/'.$img);
        $save->orientate();

        $save->resize(1200, null, function ($constraint) { $constraint->aspectRatio(); } );
        $save->save(str_replace('images/', 'full/', 'uploads/'.$img));

        $save->resize(810,  null, function ($constraint) { $constraint->aspectRatio(); });
        $save->save(str_replace('images/', 'large/', 'uploads/'.$img));

        $save->resize(510, null, function ($constraint) { $constraint->aspectRatio(); } );
        $save->save(str_replace('images/', 'medium/', 'uploads/'.$img));

        $save->resize(250, null, function ($constraint) { $constraint->aspectRatio(); });
        $save->save(str_replace('images/', 'small/', 'uploads/'.$img));

        return $img;
    }

    public static function zar($request, $key='image'){
        if(!$request->hasFile($key)){
            return null;
        }
        $img = $request->file($key)->store('zar');
        $save = Image::make('uploads/'.$img);
        $save->resize(750, 500);
        $save->save('uploads/'.$img);
        $save->resize(250, 156);
        $save->save(str_replace('zar/', 'zar/small/', 'uploads/'.$img));
        return $img;
    }



}
