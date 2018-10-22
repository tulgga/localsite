<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    public function Category(){
        return $this->hasMany(File_to_category::class, 'file_id','id')
            ->Join('file_category', 'file_category.id', '=', 'file_to_category.cat_id')
            ->orderBy('file_category.parent_id', 'asc')
            ->orderBy('file_category.order_num', 'asc');
    }

    public static  function fileType($file){

        $office=['doc', 'docx', 'xls','xlsx', 'ppt', 'pptx'];
        $image=['tiff', 'jpeg', 'gif', 'png', 'jpg', 'ico', 'bmp'];
        $pdf=['pdf'];

        $file_type = explode('.', strrev($file), 2);
        $file_type = strrev($file_type[0]);

        if(in_array($file_type, $office)){
            return 'office';
        }

        if(in_array($file_type, $image)){
           return 'image';
        }

        if(in_array($file_type, $pdf)){
            return 'pdf';
        }

        return 'none';

    }
}
