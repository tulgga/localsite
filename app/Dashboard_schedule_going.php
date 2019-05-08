<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard_schedule_going extends Model {

    /**
     * Get the post that owns the comment.
     */
    public function Dashboard_schedule()
    {
        return $this->belongsTo('App\Dashboard_schedule');
    }
    //
}
