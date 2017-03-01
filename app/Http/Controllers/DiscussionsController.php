<?php

namespace App\Http\Controllers;

use App\Discussion;
use Auth;

use Session;
use App\Reply;
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

        Session::flash('success', 'Replied to Discussion');
        return redirect()->back();
    }
}
