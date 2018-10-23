<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    public function Category(){
//        return $this->hasMany(News_to_category::class, 'post_id','id')
//            ->Join('category', 'category.id', '=', 'news_to_category.cat_id')
//            ->orderBy('category.parent_id', 'asc')
//            ->orderBy('category.order_num', 'asc');
//    }
//
//
//    public function Site(){
//        return $this->hasMany(News_to_site::class, 'post_id','id')
//            ->Join('sites', 'sites.id', '=', 'news_to_sites.site_id');
//
//    }

    public function Category(){
        return $this->hasManyThrough(Category::class, News_to_category::class,   'post_id', 'id','id','cat_id')
            ->select('category.id', 'name');
    }


    public function Site(){
        return $this->hasManyThrough(Site::class, News_to_site::class,   'post_id', 'id','id','site_id')
            ->select('sites.id', 'name', 'domain');
    }


}
