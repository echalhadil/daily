<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia as Inertia;
use Symfony\Component\Translation\Dumper\FileDumper;

class ProfileController extends Controller
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
        //get user informations
        $user = User::find($id);
        
        if($user){
                // return user friends
            $FriendshipController= new FriendshipController() ;
            $user->friends = $FriendshipController ->friends($user);

            // get user posts
            $posts = $user->posts = $user->posts;

            // get Post Comments
            foreach ($posts as $post) {

                $comments = $post->comments = $post->comments;
                $post->user = $post->user;


                // get user that's Comment
                foreach ($comments as  $comment) {

                    $comment->user = $comment->user;
                
                }
                // get likes
                $post->likes = $post->likes;
                $post->shares = $post->shares;


            }
            return  Inertia::render('Pro/Main')->with('profileUser',$user);
        }
        else
            return redirect() -> route('main');

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

    public function changePicture(Request $request)
    {
        # code...
        $request->validate([
            'picture'=>'Image|required',     
        ]);

        $user = User::find($request->id);

        if($user){
            Storage::delete($user -> picture );
            
            $picture = $request->file('picture')->store('images/users');
        
            $user->picture = 'storage/'.$picture;
    
            $user->save();

            return response() -> json($user->picture);  
        }

    } 

    public function friends($id){
        $user = User::find($id);
        // return user friends
        $FriendshipController = new FriendshipController() ;
        $friends = $FriendshipController -> friends($user);
    
        return $friends;
    }
}
