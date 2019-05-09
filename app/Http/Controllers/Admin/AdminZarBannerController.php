<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Zar_banner;

class AdminZarBannerController extends Controller
{
    public function index(){
        $info = Zar_banner::findOrFail(1);
        return response()->json([
            'success' => $info
        ]);
    }
    public function save(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $info = Zar_banner::findOrFail(1);
        $info->top_banner = $data['top_banner'];
        $info->left_banner = $data['left_banner'];
        $info->center_banner = $data['center_banner'];
        $info->save();
    }
}
