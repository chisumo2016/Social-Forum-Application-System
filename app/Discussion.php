<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //Mass Assigment

    protected  $fillable = ['title', 'content', 'user_id', 'channel_id', 'slug'];

    //Relationship
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function  replies()
    {
        return $this->hasMany('App\Reply');
    }

    public  function  watchers()
    {
        return $this->hasMany('App\Watcher');
    }

    public function is_being_watched_by_auth_user()
    {
       $id = Auth::id();
       $watcher_ids = array();

       //Get all the user who are waching to this array watcher

        foreach ($this->watchers as $w):

        array_push($watcher_ids, $w->user_id);
        endforeach;

        //Check the authenticated user are in array

        if(in_array($id, $watcher_ids)){

            return true;
        }

        else{
            return false;
        }

    }
}
