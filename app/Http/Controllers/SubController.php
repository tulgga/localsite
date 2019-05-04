<?php

namespace App\Http\Controllers;

//use http\Env\Request;
use App\News_to_category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\File;
use Illuminate\Support\Facades\Redirect;
use App\Site;
use App\Img;
use App\Page;
use App\Post;
use App\Category;
use App\File_category;
use App\File_to_category;
use App\Urgudul;
use phpDocumentor\Reflection\Location;
use function PHPSTORM_META\type;

class SubController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($account){

      $data['info']=$this->getDomainInfo($account);
      $tenders = Category::where('site_id', $data['info']->id)->where('name','Тендерийн урилга')->first();
      $data['tender_posts'] = News_to_category::orderBy('created_at','desc')->where('cat_id',$tenders->id)->get();
        $data['tender_posts']=[];
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

    public function page($account, $id){
        $data['info'] = $this->getDomainInfo($account);
        $data['page'] = Page::where('site_id', $data['info']->id)->where('id',$id)->first();
        $data['page']->menu = $this->getPageMainMenuID([['id'=>$data['page']->id, 'parent_id'=>$data['page']->parent_id, 'title'=>$data['page']->title]]);
        return view('sub.page', $data);
    }

    public function news($account, $id){
        $data['info']=$this->getDomainInfo($account);
        $data['news']= Post::where('id', $id)-> where('status',1)->with('Category')->select('id', 'title', 'image', 'type','content','created_at','view_count')->first();
        $data['news']->view_count += 1;
        $data['news']->save();
        $data['category'] = Category::where('site_id',$data['info']->id)->where('id',$data['news']['category'][0]->id)->select('*')->first();
        $data['categories'] = Category::where('site_id',$data['info']->id)->orderBy('order_num')->select('*')->get();
        $data['category']->menu = $this->getCategoryID([['id'=>$data['category']->id, 'parent_id'=>$data['category']->parent_id, 'name'=>$data['category']->name]]);
        return view('sub.news', $data);
    }

    public function category($account, $id){
        $data['info']=$this->getDomainInfo($account);
        $paginate=20;
        $data['newslist'] = Post::where('site_id',$data['info']->id)->where('status',1)->where('news_to_category.cat_id',$id)->Join('news_to_category','news_to_category.post_id', '=','posts.id')->orderBy('posts.created_at','DESC')->select('posts.title', 'posts.short_content','posts.id','posts.created_at','posts.image','posts.type')->paginate($paginate);
        $data['category'] = Category::where('site_id',$data['info']->id)->where('id',$id)->select('*')->first();
        $data['categories'] = Category::where('site_id',$data['info']->id)->orderBy('order_num','ASC')->select('*')->get();
        $data['category']->menu = $this->getCategoryID([['id'=>$data['category']->id, 'parent_id'=>$data['category']->parent_id, 'name'=>$data['category']->name]]);

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
        $site = Site::where('domain',$account)->first();
        if(is_null($site)){
            header('Location:'.env('APP_URL'));
            die();
        }
        $site->config = json_decode($site->config, true);
        $site->menu = $this->getMenu($site->id);
        $site->subDomain = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
        return $site;
    }
    public function feedback($account){
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
        $page= Page::where('site_id',$site_id)->where('is_main',1)->select('id', 'title as name', 'type', 'type_id', 'parent_id', 'blank', 'link')->orderBy('order_num', 'asc')->get();
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
        return redirect()->to('/feedback');
    }
}
