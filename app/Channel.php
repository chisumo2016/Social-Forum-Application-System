<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    //Mass Assigment
     protected  $fillable = ['title'];

    //Relationship

    public  function  discussions()
    {
        return $this->hasMany('App\Discussion');
    }
}
