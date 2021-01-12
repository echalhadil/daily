<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia as Inertia;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $FriendshipController= new FriendshipController() ;
        $friends = $FriendshipController -> friends(Auth::user());

        $returnedPosts = array();
        foreach ($friends as $friend) {
            $posts = $friend->posts = $friend ->posts;
            foreach ($posts as $post) {
                $post -> user = $post -> user ;
                $post -> likes = $post -> likes ;
                $post -> shares = $post -> shares ;
                $comments = $post -> comments = $post -> comments ;

                foreach ($comments as $comment) {
                    $comment ->user = $comment ->user ;
                }

                $returnedPosts[] = $post;
            }
            
        }
        foreach (Auth::user() -> posts as $post) {
            $post -> user = $post -> user ;
            $post -> likes = $post -> likes ;
            $post -> shares = $post -> shares ;
            $comments = $post -> comments = $post -> comments ;

            foreach ($comments as $comment) {
                $comment ->user = $comment ->user ;
            }

            $returnedPosts[] = $post;
        }
    


        return response() -> json($returnedPosts);
        
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
        $request->validate([
            'text' => 'required' ,
            'picture'=>'Image|required',     
        ]);

        $picture = $request->file('picture')->store('images/posts');
        
        $post = new Post();
        $post -> user_id = Auth::user() -> id;
        $post -> text = $request -> text;
        $post -> picture = 'storage/'.$picture;
        $post -> save();

        $post -> user = $post -> user;
        $post -> comments = $comments = $post -> comments;
        $post -> likes = $post -> likes;
        $post -> shares = $post -> shares;

        foreach($comments as $comment){     
            $comment->user = $comment->user;   //get user for every comment 
        }




        return response() -> json( $post );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $post -> user = $post -> user ;
        $post -> likes = $post -> likes ;
        $post -> shares = $post -> shares ;
        $comments = $post -> comments = $post -> comments ;

        foreach ($comments as $comment) {
            $comment ->user = $comment ->user ;
        }

        return  Inertia::render('Post/Index')->with('post',$post);



        // $post -> with('user','likes','shares','comments');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        
        $post  = Post::find($post->id);
        $post -> text  = $request->text ;
        $post -> save();
    

        return response() -> json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        if($post -> user_id == Auth::user() -> id)
        {
            $post ->comments() -> delete();
            $post ->shares() -> delete();
            $post ->likes() -> delete();
            $post -> delete();
        }
        else
            return response() -> json('no !');

        return response() -> json('ok !');
        

    }
}
