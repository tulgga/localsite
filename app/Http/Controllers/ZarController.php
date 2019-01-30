<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Link;
use App\Zar_category;
use App\Zar;

class ZarController extends Controller
{
    public function index(){
        $data=$this->MainData();
        $data['zar']=Zar::select('zar.*', 'zar_category.name as category')->join('zar_category', 'zar_category.id', '=', 'zar.cat_id')->orderBy('zar.created_at', 'desc')->paginate(12);
        return view('zar.home', $data);
    }

    public function category($id){
        $data=$this->MainData();
        $data['zar']=Zar::select('zar.*', 'zar_category.name as category')->where('zar.cat_id', $id)->join('zar_category', 'zar_category.id', '=', 'zar.cat_id')->orderBy('zar.created_at', 'desc')->paginate(12);
        return view('zar.category', $data);
    }

    public function MainData(){
        $data['sumuud'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
        $data['agentlag'] = Link::where('cat_id', 3)->orderBy('name', 'asc')->where('site_id', 0)->get();
        $data['category']= $this->buildTree(Zar_category::orderBy('order_num', 'asc')->get());
        return $data;
    }

    public function  buildTree($elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildTree($elements, $element->id);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}
