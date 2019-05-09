<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Link;
use App\Zar_category;
use App\Zar;
use App\Zar_image;
use App\Img;
use Illuminate\Support\Carbon;
use function PhpParser\filesInDir;

class ZarController extends Controller
{
    public function index(){
        $data = $this->MainData();
        /*->whereDate('zar.created_at', '>', Carbon::now()->subDays(30))*/
        $data['zar'] = Zar::select('zar.*', 'zar_category.name as category')->where('zar.is_pin',0)->join('zar_category', 'zar_category.id', '=', 'zar.cat_id')->orderBy('zar.created_at', 'desc')->paginate(12);
        $data['pinzar'] = Zar::select('zar.*', 'zar_category.name as category')->where('zar.pin_date','<=',date('Y-m-d'))->where('zar.is_pin',1)->leftJoin('zar_category', 'zar_category.id', '=', 'zar.cat_id')->orderBy('zar.created_at', 'desc')->get();
        return view('zar.home', $data);
    }

    public function search(){
        $data=$this->MainData();
        if(!isset($_GET['site_id']) && !isset($_GET['s'])) { return view(url()); }
        $cat=$_GET['site_id'];
        $s=$_GET['s'];
        $zar=Zar::select('zar.*', 'zar_category.name as category')->join('zar_category', 'zar_category.id', '=', 'zar.cat_id')->where('zar.title', 'LIKE', "%$s%");
        if($cat!=0){$zar=$zar->where('zar.site_id', $cat);}
        $data['zar']=$zar->orderBy('zar.created_at', 'desc')->paginate(12);
//        dd( $data['zar']);
        return view('zar.search', $data);
    }

    public function category($id){
        $data=$this->MainData();

        $childs=Zar_category::where('parent_id', $id)->get();

        $zar=Zar::select('zar.*', 'zar_category.name as category')->join('zar_category', 'zar_category.id', '=', 'zar.cat_id');

        if(count($childs)>0){
            foreach ($childs as $child): $ids[]=$child->id; endforeach;
            $zar=$zar->whereIn('zar.cat_id', $ids);
        } else {
            $zar=$zar->where('zar.cat_id', $id);
        }

        $data['zar']=$zar->orderBy('zar.created_at', 'desc')->paginate(12);
        $data['zar_cat']=$id;
        $data['selected_cat']=Zar_category::find($id);
        return view('zar.category', $data);
    }

    public function single($id)
    {
        $data=$this->MainData();
        $data['zar']=Zar::find($id);
        $data['selected_cat']=Zar_category::find($data['zar']->cat_id);
        $data['images']=Zar_image::where('zar_id', $id)->get();
        return view('zar.single', $data);
    }

    public function add(){
        $data=$this->MainData();
        return view('zar.addZar', $data);
    }


    public function postAdd(Request $request){

        $zar= new Zar();
        $zar->cat_id=$request->cat_id;
        $zar->site_id=$request->site_id;
        $zar->title=strip_tags($request->title);
        $zar->content=strip_tags($request->post('content'));
        $zar->price=strip_tags($request->price);
        $zar->phone=strip_tags($request->phone);
        $zar->email=strip_tags($request->email);
        $zar->save();

        if($request->file()){
            $i=1;
            foreach ($request->file() as $key=>$file){
                $img=Img::zar($request, $key);
                if($i==1){
                    $zar->image=$img;
                    $zar->save();
                }
                else {
                    $zar_image= new Zar_image();
                    $zar_image->zar_id=$zar->id;
                    $zar_image->image=$img;
                    $zar_image->save();
                }
                $i++;
            }
        }
        return redirect(url('/p/'.$zar->id.'.html'));
    }



    public function MainData(){
        $data['sumd'] = Site::select('id','name')->where('id','!=',0)->orderBy('name','ASC')->get();
        $data['sumuud'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
        $data['agentlag'] = Link::where('cat_id', 3)->orderBy('name', 'asc')->where('site_id', 0)->get();
        $data['category']= $this->buildTree(Zar_category::orderBy('order_num', 'asc')->get());
        $data['selected_cat']=[];
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
