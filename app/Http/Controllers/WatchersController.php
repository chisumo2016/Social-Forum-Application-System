<?php

namespace App\Http\Controllers;


use Auth;


use Session;
use Illuminate\Http\Request;
use App\Watcher;

class WatchersController extends Controller
{
    //

    public  function  watch($id)
    {
        Watcher::create([
            'discussion_id' => $id,
            'user_id'       => Auth::id()
        ]);

       // Session:flash('success', 'You are watching this discussion');


        return redirect()->back();
    }


    public  function  unwatch($id)
    {
        $watcher = Watcher::where('discussion_id', $id)->where('user_id', Auth::id());

        $watcher->delete();


        Session()->flash('success', 'You are no watching this discussion');


        return redirect()->back();
    }
}
