<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //Mass Assigment

    protected $fillable =['content', 'user_id', 'discussion_id'];

    //Relationship

    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }
}
