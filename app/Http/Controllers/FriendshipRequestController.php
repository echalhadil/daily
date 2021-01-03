<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\FriendshipRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(! $this->exist($request -> id))
        {
            $request -> validate([
                'id' =>'required|numeric',
            ]);

            $user = User::find(Auth::user() -> id);
            $friendshipRequest = $user -> friendshipsRequestFrom() 
                -> create([
                    'to_id' => $request -> id,
                ]);
            return response() -> json($friendshipRequest);   

        }
        
        return response() -> json(false);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FriendshipRequest  $friendshipRequest
     * @return \Illuminate\Http\Response
     */
    public function show(FriendshipRequest $friendshipRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FriendshipRequest  $friendshipRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(FriendshipRequest $friendshipRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FriendshipRequest  $friendshipRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FriendshipRequest $friendshipRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FriendshipRequest  $friendshipRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FriendshipRequest $friendshipRequest)
    {
         $friendshipRequest = FriendshipRequest::find($friendshipRequest -> id);
         $friendshipRequest -> delete();
        
         return response() -> json(true);
    }




    public function find($id)
    {
        $user = Auth::user();

        $friendshipRequest1 = FriendshipRequest::where('from_id',$user -> id)
                            -> where('to_id',$id)
                            -> first();
        if (! $friendshipRequest1)
        {
            $friendshipRequest2 = FriendshipRequest::where('to_id',$user -> id)
                -> where('from_id',$id)
                -> first();

            if($friendshipRequest2)
                return response() -> json($friendshipRequest2);
            else
                return response() -> json(false);
        }
        else
      
            return response() -> json($friendshipRequest1);
        
    }

    // exesting request ?
    public function exist($id)
    {
        # code...
        $exist1 = FriendshipRequest::where('from_id',Auth::user() -> id)
        -> where('to_id',$id)
        -> first();

        $exist = FriendshipRequest::where('from_id',$id)
        -> where('to_id',Auth::user() -> id)
        -> first();

        if(!$exist1 && !$exist)
            return false;
        
        return true;

    }

    public function confirm($id)
    {

        $friendshipRequest = FriendshipRequest::find($id);

        $friendship = new Friendship();
        $friendship -> user_id = $friendshipRequest -> from_id;
        $friendship -> friend_id = $friendshipRequest -> to_id;
        $friendship -> status = 'f';
        $friendship -> save();

        $friendshipRequest -> delete();
        
        return response() -> json(true);

    }
}
