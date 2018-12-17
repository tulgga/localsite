<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Link_category;
use App\Link;

class ApiLinkController extends Controller
{
    public function agentlag(){
        $Links=Link::where('cat_id', 3)->orderBy('name', 'asc')->where('site_id', 0)->get();
        return response()->json([ 'success' => $Links ]);
    }
}
