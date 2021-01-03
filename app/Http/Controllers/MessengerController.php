<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia as Inertia;



class MessengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // $con =array();


        // foreach ($user -> conversationsFrom as $conversation) {  
                
        //     $conversation -> messages = $conversation -> messages ;
        //     $conversation->user = User::find($conversation->to_id);
        //     $con[] = $conversation;
        // }

        // foreach ($user -> conversationsTo as $conversation) {  
               
        //     $conversation -> messages = $conversation -> messages ;
        //     $conversation->user = User::find($conversation->from_id);
        //     $con[] = $conversation;
        // }
           
    
        
        // $FriendshipController = new FriendshipController();
        // $friends = $FriendshipController -> friends($user);

        // return  Inertia::render('Messenger/Index')
        //         ->with('conversations' , $con)
        //         ->with('friends' , $friends);

         return  Inertia::render('Messenger/Main');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    public function conversation($id)
    {
        $conversation = Conversation::find($id);
        $conversation -> readed = true;
        $conversation -> save();

        if($conversation -> from_id == Auth::user() -> id)
            $friend = User::find($conversation -> to_id);
        else
            $friend = User::find($conversation -> from_id);
        return Inertia::render('Messenger/ConversationPanel')
            -> with('id',$id)
            -> with('friend',$friend);
            
    }
}
