<?php

namespace App\Http\Controllers;


use Auth;
use Session;
use App\User;
use App\Reply;
use Notification;
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

        $discussion = Discussion::create([
            'title'      => $r->title,
            'content'    => $r->content,
            'channel_id' => $r->channel_id,
            'user_id'     => Auth::id(),
            'slug'        =>str_slug($r->title)

        ]);

        session()->flash('success', 'Discussion succesfully created.');


        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }



    public function  show($slug)
    {
        //        $d = Discussion::where('slug', $slug)->first();
//
//        return view('discussion.show', compact('d'));
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
        return view('discussion.show')
            ->with('d', $discussion)
            ->with('best_answer', $best_answer);

    }


    public function reply($id)
    {
        $d = Discussion::find($id);



        $reply = Reply::create([
            'user_id'        => Auth::id(),
            'discussion_id'  => $id,
            'content'      =>request()->reply
        ]);


        // Increament the user reply
        $reply->user->points += 25;
        $reply->user->save();

        //Detecting watcher
        $watchers = array();
        foreach ($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id)); // Push user object
        endforeach;

        //Send a Notification     dd($watchers);

       Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));

        session()->flash('success', 'Replied to Discussion');
        return redirect()->back();
    }


}
