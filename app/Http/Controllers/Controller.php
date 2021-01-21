<?php

namespace App\Http\Controllers;

use http\Env\Request;
use http\Url;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\File;
use Illuminate\Support\Facades\Redirect;
use App\Site;
use App\Settings;
use App\Post;
use App\Link;
use App\Page;
use App\Worker;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function addMenu(){
        $sites=Site::whereNotIn('id', [0,50])->get();
        $pages=Page::where('site_id', 50)->orderBy('id','asc')->get();

        foreach ($sites as $site){
            foreach ($pages as $p){
                $page= new Page();
                $page->id=$p->id+$site->id*1000;
                $page->title=$p->title;
                $page->image=$p->image;
                $page->text=$p->text;
                $page->site_id=$site->id;
                $page->order_num=$p->order_num;
                if(!is_null($p->parent_id)){
                    $page->parent_id=$p->parent_id+$site->id*1000;
                }
                $page->link='/p/'.($p->parent_id+$site->id*1000);
                $page->is_main=$p->is_main;
                $page->icon=$p->icon;
                $page->save();
            }
        }

    }
    public function homePage(){
        $info = Site::findOrFail(0);
        $data['config']= json_decode($info->config, true);
        $data['logo']= url('/uploads/'.$info->logo);
        $data['favicon']= url('/uploads/'.$info->favicon);
        $data['mainConfig']=Settings::where('id', 1)->select('google_api_key', 'google_analytics')->first();
        $data['sumuud'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
        $data['links']=Link::where('cat_id', 3)->orderBy('name', 'asc')->where('site_id', 0)->get();
        return view('homePage', $data);
    }

    public function saveAble(){
        $company=file_get_contents('https://intranet.gov.mn/insight.php?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1NTc4ODMxNjF9.ACl3LBLZhdX1rd3UYynrn6UhzoSEFoEqo-n_m0xsUqU&a=bayankhongor&getInfo=bayankhongor');
        $data = json_decode($company, true);
        foreach ($data as $dt){
            if($dt['type'] == 2) {
                $find = Worker::where('oid',$dt['id'])->first();
                if(is_null($find)){
                    $worker = New Worker();
                }else{
                    $worker = Worker::findOrFail($find->id);
                }
                $worker->oid = $dt['id'];
                $worker->mid = $dt['mid'];
                $worker->preid = $dt['preid'];
                $worker->type = $dt['type'];
                $worker->name = $dt['name'];
                $worker->childrenCnt = $dt['childrenCnt'];
                $worker->json_data = json_encode($dt['children']);
                $worker->save();
            }
        }
    }

    public function index(){
        if(isset($_GET['id'])){
            return redirect('!#/news/'.$_GET['id']);
        }
        $week=['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'];
        $data['date']=date('m сарын d, ').$week[date('w')];

        $info = Site::findOrFail(0);
        $data['config']= json_decode($info->config, true);
        $data['logo']= url('/uploads/'.$info->logo);
        $data['favicon']= url('/uploads/'.$info->favicon);
        $data['mainConfig']=Settings::where('id', 1)->select('google_api_key', 'google_analytics')->first();
        if(isset($_GET['id'])){ $data['news']= Post::where('id', $_GET['id'])->where('status', 1)->with('Category')->first();}
        else { $data['news']=false;}
        return view('main', $data);
    }



    public function file_viewer(){

        if(isset($_GET['file'])){
            $data['file']=url('uploads/'.$_GET['file']);
            $type=File::fileType($_GET['file']);
            if($type=='none'){
                return 'Энэ хүү файлын төрлийг үзэх боломжгүй';
            }
            if($type=='pdf'){
                return Redirect::to($data['file']);
            }
            if($type=='image'){
                return view('fileView', $data);
            }
            if($type=='office'){
                return Redirect::to('https://view.officeapps.live.com/op/view.aspx?src='.$data['file']);
            }

        } else {
            return 'Файл олдсонгүй';
        }
    }
    public function fb_share_news($id){
        $news = Post::where('posts.site_id',0)->where('posts.id', $id)->where('posts.status', 1)
            ->select('posts.*', 'sites.name as site', 'sites.domain')
            ->Join('sites', 'sites.id', '=', 'posts.site_id')
            ->with('Category')->first();
//        dd($news);
        $result ='<!DOCTYPE html>
                    <html lang="mn">
                    <head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <title>'.$news->title.'</title>
                            <meta name="keywords" content="'.$news->short_content.'">
                            <meta name="description" content="'.$news->short_content.'">
                            <meta property="og:title" content="'.$news->title.'">
                            <meta property="og:image" content="https://www.bayankhongor.gov.mn/uploads/'.$news->image.'">
                            <meta property="og:url" content="'.$news->domain.'">
                            <meta property="og:description" content="'.$news->short_content.'"> 
                    </head>
                    <body style="text-align: center">
                    <h3>'.$news->title.'</h3>
                    <p><strong>Нийтэлсэн:</strong> '.$news->created_at.'</p>
                    <img src="https://www.bayankhongor.gov.mn/uploads/'.$news->image.'">
                    '.$news->content.'
                    </body>
                    </html>';
        return $result;
    }
}
