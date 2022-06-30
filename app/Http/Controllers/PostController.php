<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Categorie;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category','user')->latest()->get();
        return view('posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Categorie::all();
        return view('posts.create',['categorys' => $categorys]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imageName = $request->image->store('posts'); //créé un dossier posts
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
        ]);

        return redirect()->route('dashboard')->with('success','Votre post a été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!Gate::allows('update-post',$post)){
            abort('403','Cherche encore');
        }
        $categorys = Categorie::all();
        return view('posts.edit',['post' => $post, 'categorys' => $categorys]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $arrayUpdate = [
            'title' => $request->title,
            'content' => $request->content,
        ];

        if($request->image != null) {
            $imageName = $request->image->store('posts');
            $arrayUpdate = array_merge($arrayUpdate, ['image'=> $imageName]);
        }

        $post->update($arrayUpdate);

        return redirect()->route('dashboard')->with('success','Votre post a été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(!Gate::allows('destroy-post',$post)){
            abort('403','Cherche encore');
        }
        $post->delete();

        return redirect()->route('dashboard')->with('success','Votre post a été supprimé');
    }
}
