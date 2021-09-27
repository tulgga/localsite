<?php

namespace App\Http\Controllers;

use App\Dashboard_schedule;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\File;
use App\Site;
use App\Img;
use App\Page;
use App\Post;
use App\Category;
use App\File_category;
use App\File_to_category;
use App\Urgudul;
use App\Zar;
use App\Worker;

class SubController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($account){
      $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
      $data['date']=date('m сарын d, ').$week[date('w')];
      $data['home_url'] = env('SUB_DOMAIN', 'bkh.gov.mn');
      $data['info'] = $this->getDomainInfo($account);
        $data['zar'] = Zar::select('zar.id','zar.title','zar.image','zar.created_at','zar_category.name','zar.cat_id')->where('zar.site_id',$data['info']->id)->Join('zar_category', 'zar_category.id','=','zar.cat_id')->orderBy('zar.created_at','DESC')->limit(20)->get();
      $data['ontslokh']= Post::orderBy('created_at', 'desc')->where('site_id', $data['info']->id)->where('is_primary', 1)->where('status',1)->with('Category')->select('title', 'id', 'image', 'type','short_content','created_at')
          ->limit(5)->get();
      $data['latest_news']= Post::orderBy('created_at', 'desc')->where('site_id', $data['info']->id)->where('is_primary', 0)->where('status',1)->with('Category')->select('title', 'id', 'image', 'type','short_content','created_at')
            ->limit(6)->get();
      $data['province_news'] = Post::orderBy('posts.created_at', 'desc')->
      where('posts.site_id', 0)->
      where('posts.status',1)->with('Category')->
      select('posts.title', 'posts.id', 'posts.image', 'posts.type','posts.created_at')->
          Join('news_to_sites', 'news_to_sites.post_id', '=', 'posts.id')
          ->whereIn('news_to_sites.site_id', [$data['info']->id,0])
          ->limit(6)->get();

      $data['other_menu'] = Page::where('site_id',$data['info']->id)->where('is_main',0)->select('id', 'title as name', 'link', 'icon', 'type', 'type_id')->orderBy('order_num', 'asc')->get();
      return view('sub.home', $data);
    }
    public function search($account){

        $data['info'] = $this->getDomainInfo($account);
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();
        $data['zar'] = Zar::select('zar.id','zar.title','zar.image','zar.created_at','zar_category.name','zar.cat_id')->where('zar.site_id',$data['info']->id)->Join('zar_category', 'zar_category.id','=','zar.cat_id')->orderBy('zar.created_at','DESC')->limit(20)->get();
        $data['posts'] = Post::select('title','id','short_content','image','type')->where('site_id',$data['info']->id)->where('title','LIKE','%'.$_GET['search_query'].'%')->get();
        //echo json_encode($data['posts']); die;
        return view('sub.pageTemplates.page-search', $data);

    }
    public function page($account, $id){
        $data['info'] = $this->getDomainInfo($account);
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();
        $data['zar'] = Zar::select('zar.id','zar.title','zar.image','zar.created_at','zar_category.name','zar.cat_id')->where('zar.site_id',$data['info']->id)->Join('zar_category', 'zar_category.id','=','zar.cat_id')->orderBy('zar.created_at','DESC')->limit(20)->get();

        $data['page'] = Page::where('site_id', $data['info']->id)->where('id',$id)->first();
        $data['page']->menu = $this->getPageMainMenuID([['id'=>$data['page']->id, 'parent_id'=>$data['page']->parent_id, 'title'=>$data['page']->title]]);
        return view('sub.page', $data);
    }
    public function news($account, $id){
        $data['info']=$this->getDomainInfo($account);
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();
        $data['zar'] = Zar::select('zar.id','zar.title','zar.image','zar.created_at','zar_category.name','zar.cat_id')->where('zar.site_id',$data['info']->id)->Join('zar_category', 'zar_category.id','=','zar.cat_id')->orderBy('zar.created_at','DESC')->limit(20)->get();

        $data['news']= Post::where('id', $id)->where('status',1)->with('Category')->select('id', 'title', 'image', 'type','content','created_at','view_count')->first();
        $data['news']->view_count += 1;
        $data['news']->save();
        $data['category'] = Category::where('site_id',$data['info']->id)->where('id',$data['news']['category'][0]->id)->select('*')->first();
        $data['categories'] = Category::where('site_id',$data['info']->id)->orderBy('order_num')->select('*')->get();
        $data['category']->menu = $this->getCategoryID([['id'=>$data['category']->id, 'parent_id'=>$data['category']->parent_id, 'name'=>$data['category']->name]]);
        
        // echo json_encode($data); die;
        return view('sub.news', $data);
    }

    public function category($account, $id){
        $data['info'] = $this->getDomainInfo($account);
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date'] = date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();

        $data['zar'] = Zar::select('zar.id','zar.title','zar.image','zar.created_at','zar_category.name','zar.cat_id')->where('zar.site_id',$data['info']->id)->Join('zar_category', 'zar_category.id','=','zar.cat_id')->orderBy('zar.created_at','DESC')->limit(20)->get();
        $paginate=20;
        $data['newslist'] = Post::where('site_id',$data['info']->id)->where('status',1)->where('news_to_category.cat_id',$id)->Join('news_to_category','news_to_category.post_id', '=','posts.id')->orderBy('posts.created_at','DESC')->select('posts.title', 'posts.short_content','posts.id','posts.created_at','posts.image','posts.type')->paginate($paginate);
        $data['category'] = Category::where('site_id',$data['info']->id)->where('id',$id)->select('*')->first();
        //echo json_encode($data['category']); die;
        $data['categories'] = Category::where('site_id',$data['info']->id)->orderBy('order_num','ASC')->select('*')->get();
        $data['category']->menu = $this->getCategoryID([['id'=>$data['category']->id, 'parent_id'=>$data['category']->parent_id, 'name'=>$data['category']->name]]);
        
        
        $list_type= 0;
        
        if(count(Page::where("type", 2)->where("type_id", $id)->where("site_id", $data["info"]->id)->get()) > 0){
            $list_type= Page::where("type", 2)->where("type_id", $id)->where("site_id", $data["info"]->id)->first();
            
            if($list_type){
                $list_type=$list_type->list_type;
            }
        }
        $data['list_type']=$list_type;
        return view('sub.category', $data);
    }
    public function archive($account){
        $data['info']=$this->getDomainInfo($account);
        $data['newslist'] = Post::where('site_id',$data['info']->id)->where('status',1)->orderBy('posts.created_at','DESC')->with('Category')->select('*')->get();
        $data['categories'] = Category::where('site_id',$data['info']->id)->orderBy('order_num','ASC')->select('*')->get();
        return view('sub.archive', $data);
    }

    public function files($account, $id){
        $data['info']=$this->getDomainInfo($account);
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();
        $data['zar'] = Zar::select('zar.id','zar.title','zar.image','zar.created_at','zar_category.name','zar.cat_id')->where('zar.site_id',$data['info']->id)->Join('zar_category', 'zar_category.id','=','zar.cat_id')->orderBy('zar.created_at','DESC')->limit(20)->get();

        $data['fileCat'] = File_to_category::where('cat_id',$id)->select('file_id')->first();
        if(isset($data['fileCat']->file_id)) {
            $data['filelist'] = File::where('site_id', $data['info']->id)->where('id', $data['fileCat']->file_id)->where('status', 1)->select('*')->orderBy('created_at', 'DESC')->get();
        }else{
            $data['filelist'] = [];
            $data['infoMessage'] = "Мэдээлэл ороогүй байна.";
        }
        $data['fileCategory'] = File_category::where('site_id',$data['info']->id)->where('id',$id)->select('id', 'name')->first();
        $data['fileCategories'] = File_category::where('site_id',$data['info']->id)->orderBy('order_num','ASC')->select('id', 'name')->get();
        return view('sub.file', $data);
    }

    public function getDomainInfo($account){
        date_default_timezone_set('Asia/Ulaanbaatar');
        $start=date('Y-m-d');
        $end=date('Y-m-d', strtotime( '+7 days' ));
        $site = Site::where('domain',$account)->first();
        if(is_null($site)){
            header('Location:'.env('APP_URL'));
            die();
        }
        $site->config = json_decode($site->config, true);
        $site->menu = $this->getMenu($site->id);
        $site->menu_head = $this->getHeadMenu($site->id);
        $site->subDomain = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();

        $site->agent = [];
        if(count(Link::where('site_id', $site->id)->limit(10)->get())){
            $site->agent=Link::where('site_id', $site->id)->limit(10)->get();
        }

        $site->events = [];
        if(count(Dashboard_schedule::where('site_id', $site->id)
            ->whereBetween('schedule_date', [$start, $end])
            ->whereIn('head_id', [4,5,6,7,8,9])
            ->where("is_publish", 1)
            ->get())>0){
            $site->events = Dashboard_schedule::where('site_id', $site->id)
                ->whereBetween('schedule_date', [$start, $end])
                ->whereIn('head_id', [4,5,6,7,8,9])
                ->where("is_publish", 1)
                ->get();
        }

        return $site;
    }
    public function feedback($account){
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();
        $data['info']=$this->getDomainInfo($account);
        $urgudul = Urgudul::where('site_id',$data['info']->id)->orderBy('created_at','DESC');

        if(isset($_GET['status'])){
            if($_GET['status']==1){
                $urgudul=$urgudul->whereNotNull('reply');
            } else {
                $urgudul=$urgudul->whereNull('reply');
            }
        }

        $data['feedlist']=$urgudul->paginate(50);
        return view('sub.pageTemplates.page-feedback', $data);
    }

    public function getMenu($site_id){
        $page= Page::where('site_id',$site_id)
            ->where('is_main',1)
            ->select('id', 'title as name', 'type', 'type_id', 'parent_id', 'blank', 'link')
            ->orderBy('order_num', 'asc')
            ->get();
        return  $this->buildTree($page);
    }

    public function getHeadMenu($site_id){
        $page= Page::where('site_id',$site_id)
            ->where('is_main',2)
            ->select('id', 'title as name', 'type', 'type_id', 'parent_id', 'blank', 'link')
            ->orderBy('order_num', 'asc')
            ->get();
        return  $this->buildTree($page);
    }

    public function  buildTree($elements, $parentId = null) {
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
    public function getCategoryID($menu){
        if($menu[0]['parent_id'] == 0){
            return $menu;
        } else {
            $category = Category::find($menu[0]['parent_id']);
            array_unshift( $menu, ['id'=>$category->id, 'parent_id'=>$category->parent_id, 'name'=>$category->name]);
            if($category){
                return $this->getCategoryID($menu);
            }
        }
    }
    public function getPageMainMenuID($menu){
        if(is_null($menu[0]['parent_id'])){
            return $menu;
        } else {
            $page=Page::find($menu[0]['parent_id']);
            array_unshift( $menu, ['id'=>$page->id, 'parent_id'=>$page->parent_id, 'title'=>$page->title]);
            if($page){
                return   $this->getPageMainMenuID($menu);
            }
        }
    }
    public function urgudul_save($account,Request $request){
        $data['info']=$this->getDomainInfo($account);
        $urgudul = new Urgudul;
        $urgudul->image = Img::upload($request);
        $urgudul->site_id = $data['info']->id;
        $urgudul->type = $request->get('type');
        $urgudul->name = $request->get('your_name');
        $urgudul->phone = $request->get('your_phone');
        $urgudul->email = $request->get('your_email');
        $urgudul->content = $request->get('your_message');
        $urgudul->ip = $_SERVER['REMOTE_ADDR'];
        $urgudul->user_agent=$_SERVER['HTTP_USER_AGENT'];
        $urgudul->save();
        $request->session()->flash('successMsg', 'Таны зурвас амжилттай илгээгдлээ!');
        return redirect()->to('/feedback');
    }
    public function able($account){
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];
        $data['home_url'] = Site::select('domain')->where('id',0)->first();
        $data['info']=$this->getDomainInfo($account);

        $able = Worker::where('oid',$data['info']->able_id)->first();
        $data['ables'] = json_decode($able['json_data'],true);
        return view('sub.pageTemplates.page-able',$data);
    }
}
