<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Dashboard_schedule extends Model
{

    /**
     * Get the comments for the blog post.
     */
    public function Dashboard_schedule_going()
    {
        return $this->hasMany('App\Dashboard_schedule_going');
    }
}
