<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $c = array();

        foreach ($user->conversationsFrom as $conversation) {
            if($conversation->last_message!='')
            {
                $conversation->user = User::find($conversation->to_id);
                $c[] = $conversation;
            }
        }

        foreach ($user->conversationsTo as $conversation) {
            if($conversation->last_message!='')
            {
                $conversation->user = User::find($conversation->from_id);
                $c[] = $conversation;
            }
        }

        return response() -> json($c);


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
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {   
        $conversation -> messages = $conversation -> messages;

        if($conversation -> from_id == Auth::user() -> id)
            $conversation -> friend = User::find($conversation -> to_id);
        else
            $conversation -> friend = User::find($conversation -> from_id);

       
        return response() -> json($conversation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }


    

    public function new($id)
    {
        # code...

        $exist = Conversation::where('from_id',Auth::user()->id) 
                    -> where('to_id',$id)
                    -> first();
        if($exist)
        {
            $friend = User::find($exist -> to_id);
            return Inertia::render('Messenger/ConversationPanel')
                -> with('id',$exist -> id )
                -> with('friend',$friend);
                
            
        }
        else
        {
            $exist = Conversation::where('from_id',$id) 
                    -> where('to_id',Auth::user()->id)
                    -> first();
            if($exist)
            {
                $friend = User::find($exist -> from_id);
                return Inertia::render('Messenger/ConversationPanel')
                    -> with('id',$exist -> id)
                    -> with('friend',$friend);
            }
            else
            {
                $user = User::find( Auth::user() -> id );
                $friend = User::find($id);

                $conversation = $user -> conversationsFrom() -> create([
                    'to_id' => $id,
                    'readed' => true,
                ]);

                return Inertia::render('Messenger/ConversationPanel')
                    -> with('id',$conversation -> id)
                    -> with('friend',$friend);
            }

        }
    }


 
}
