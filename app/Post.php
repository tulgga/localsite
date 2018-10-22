<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function Category(){
        return $this->hasMany(News_to_category::class, 'post_id','id')
            ->Join('category', 'category.id', '=', 'news_to_category.cat_id')
            ->orderBy('category.parent_id', 'asc')
            ->orderBy('category.order_num', 'asc');
    }
}
