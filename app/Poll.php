<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function Answer(){
        return $this->hasMany(Poll_answer::class, 'poll_id','id')
            ->orderBy('poll_answers.id', 'asc');
    }
}
