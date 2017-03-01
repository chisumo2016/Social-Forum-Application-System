<?php

namespace App\Http\Controllers;

use Session;
use App\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $channel = Channel::all();
        return view('admin.channels.index', compact('channel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'channel' => 'required'
        ]);

        Channel::create([
            'title' => $request->channel,
            'slug'  => str_slug($request->channel)
        ]);

        Session::flash('success', 'Channel Created');

        return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $channel = Channel::find($id);
        return view('admin.channels.edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $channel = Channel::find($id);

        $channel->title = $request->channel;
        $channel->slug = $request->str_slug($request->channel);


        $channel->save();

        Session::flash('success', 'Channel Edited Successfull');

        return redirect()->route('channels.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Channel::destroy($id);

        Session::flash('succes', 'Channel Deleted');

        return redirect()->route('channels.index');
    }
}
