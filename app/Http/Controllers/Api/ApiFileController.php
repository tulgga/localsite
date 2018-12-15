<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File_category;
use App\File;
use App\File_to_category;


class ApiFileController extends Controller
{
    public function boxFileList($cat_id){
        $files=File::Join('file_to_category', 'file_to_category.file_id', '=', 'files.id')
            ->where('file_to_category.cat_id', $cat_id)
            ->select('files.*')
            ->orderBy('files.created_at', 'desc')
            ->paginate(50);
        return response()->json(['success'=>$files]);
    }
}
