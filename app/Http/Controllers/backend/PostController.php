<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('id','title');
        $tags = Tag::pluck('id','title');
        $post = new Post();
        return view('backend.post.create',compact('post','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request) 
    {
        // obtenemos el array con los parámetros del request
        $requestData = $request->validated();
        $post = Post::create($requestData);
        if ( isset($requestData['tags']) )
            $post->tags()->attach($requestData['tags']);
        return redirect()->route('post.index')->with('status', 'Registro añadido');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id','title');
        $tags = Tag::pluck('id','title');
        return view('backend.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        if( isset($data["image"])){
            $data["image"] = $filename = time().".".$data["image"]->extension();

            $request->image->move(public_path("image/otro"), $filename);
            
        }
        $post->update($data );
        isset($data['tags']) ?
                    $post->tags()->sync($data['tags'])
                :
                    $post->tags()->detach();
        return redirect()->route('post.index')->with('status', 'Registro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();        
        return redirect()->route('post.index');
    }
}
