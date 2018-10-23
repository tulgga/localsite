<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zar_category;

class ApiZarCategoryController extends Controller
{
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

    public function zarCategory(){
        $zarCategory= Zar_category::select('zar_category.*', 'zar_category.name as label')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($zarCategory) ]);
    }

    public function getById($id)
    {
        $zarCategory= Zar_category::where('id', $id)->orWhere('parent_id', $id)->select('zar_category.*', 'zar_category.name as label')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($zarCategory) ]);
    }
}
