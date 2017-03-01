<?php

namespace App\Http\Controllers;


use Auth;


use Session;


use App\User;
use App\Reply;
use App\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    //

    public function  create()
    {
        return view('discuss');
    }

    public function  store()
    {
           $r = request();

        $this->validate($r, [
            'channel_id' => 'required',
            'content'    => 'required',
            'title'      => 'required'
        ]);

        $discussions = Discussion::create([
            'title'      => $r->title,
            'content'    => $r->content,
            'channel_id' => $r->channel_id,
            'user_id'     => Auth::id(),
            'slug'        =>str_slug($r->title)

        ]);

        Session::flash('success', 'Discussion successfully created');


        return redirect()->route('discussions', ['slug' => $discussions->slug]);
    }



    public function  show($slug)
    {
        $d = Discussion::where('slug', $slug)->first();

        return view('discussion.show', compact('d'));
    }


    public function reply($id)
    {
        $d = Discussion::find($id);



        $reply = Reply::create([
            'user_id'        => Auth::id(),
            'discussion_id'  => $id,
            'content'      =>request()->reply
        ]);
        
        //Detecting watcher
        $watchers = array();
        foreach ($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id)); // Push user object
        endforeach;

        dd($watchers);


        Session::flash('success', 'Replied to Discussion');
        return redirect()->back();
    }
}
