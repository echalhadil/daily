<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function show(Friendship $friendship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function edit(Friendship $friendship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friendship $friendship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friendship $friendship)
    {
        //
    }


    public function friendshipStatus(request $request)
    {
        $exist = Friendship::where('user_id',Auth::user()-> id)
            ->where('friend_id',$request -> id)
            ->first();
        if(! $exist)
        {
            $exist = Friendship::where('friend_id',Auth::user()-> id)
                    ->where('user_id',$request -> id)
                    ->first();
            if(! $exist)
            {
                return response() -> json(false) ;

            }
            else
    
                return response() -> json(true) ;
            
        }
        else
        {
            return response() -> json(true) ;

        }
    }


    public function friends(User $user = null  )
    {
        if($user == null)
         $user = User::find(Auth::user() -> id) ;
         
        $friends = array();

        $user->friendshipsFromUserId;

        foreach ($user->friendshipsFromUserId as $friendship) {
            $friends[] = User::find($friendship->friend_id);
        }

        foreach ($user->friendshipsFromFriendId as $friendship) {
            $friends[] = User::find($friendship->user_id);
        }
        return $friends;
        
    }

    public function addFriend(Request $request)
    {
        return User::find(Auth::user()->id)
            ->friendshipsFromUserId()
            ->create([
                'friend_id' => $request ->friend_id,
                'status' =>'p',

        ]);

    }

    public function unfriend($id)
    {
        $exist1 = Friendship::where('user_id','=',Auth::user() -> id)
                ->where('friend_id','=',$id)
                ->first();

        $exist2 = Friendship::where('friend_id','=',Auth::user() -> id)
                ->where('user_id','=',$id)
                ->first();

        if($exist1){
            $exist1 -> delete();
            return response() ->json(true); 
        }
        if($exist2){
            $exist2 -> delete();
            return response() ->json(true); 
        }
        
        return response() ->json(false);
     
    }

    public function acceptFriend(Request $request)
    {
        $exist = Friendship::where('user_id',Auth::user()-> id)
                ->where('friend_id',$request -> friend_id)
                ->first();
        if(! $exist)
        {
            $exist = Friendship::where('friend_id',Auth::user()-> id)
                    ->where('user_id',$request -> friend_id)
                    ->first();
            $exist -> status = 'a';
            $exist -> save();
            return response() -> json( $exist ) ;
            
        }
        else
        {
            $exist -> status = 'a';
            $exist -> save();
            return response() -> json( $exist ) ;

        }


    }


   
}
