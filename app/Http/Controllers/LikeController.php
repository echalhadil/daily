<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

use function PHPSTORM_META\type;

class LikeController extends Controller
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
        $post = Post::find($request -> id); // to get the post.

        $exist = Like::where([
            ['user_id','=', Auth::user() -> id],
            ['post_id','=', $request -> id],
        ])->first(); // to test if the like already in database.

        if(! $exist)
        {
 
            $like = $post -> likes() -> create([
                'user_id' => Auth::user() -> id,
            ]); // store the post like.

            if($post -> user -> id != Auth::user() -> id)  //test if the user is the post owner or not.
            {
                $exist = Notification::where([
                    ['type','=','like'],
                    ['maker_id','=', Auth::user() -> id],
                    ['post_id','=', $request -> id],
                ])->first(); //test if the notification is already there in db.

                if(! $exist)
                {
                    $user = User::find( $post -> user -> id );

                    $notifiction = $user ->notifications() -> create([
                        'type'      => 'like',
                        'maker_id'  => Auth::user() -> id,
                        'post_id'   => $request -> id
                    ]); // store the notification to the post ower.
                    
                    // broadcast notification 
                    // broadcast( new NotificationEvent($user,$notifiction) ) -> toOthers();
                }
            }

            return response() -> json( $like ); // returns the like info .
        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
        $like = Like::find($like->id); // find the like.

        if($like)
        try {
            return response()->json($like->delete()); // delete the like info from db.

        } catch (\Throwable $th) {
            return response()->json($th);

        }
    }
}
