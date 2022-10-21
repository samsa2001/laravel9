<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('posted','yes')->with('category')->with('tags')->paginate(10);
        return response()->json($posts);
    }
    
    public function all()
    {
        $posts = Post::with('tags')->get();
        return response()->json($posts);
    }
    
    public function slug(Post $post)
    {
        //$post = Post::with('category')->where("url_clean",$slug)->firstOrFail();
        $post->category;
        $post->tags;
        // dd($post->tags()->get());
        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        if ( isset($data['tags']) )
            $post->tags()->attach($data['tags']);
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post);
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
        $post->update($data);
        isset($data['tags']) ?
                    $post->tags()->sync($data['tags'])
                :
                    $post->tags()->detach();
        return response()->json($post);
    }

    public function upload(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png|max:10240'
        ]);

        Storage::disk('public_upload')->delete("image/otro/" . $post->image);

       $data["image"] = $filename = time() . "." . $request["image"]->extension();
       $request->image->move(public_path("image/otro"), $filename);
 
       $post->update($data);
 
       return response()->json($post);
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
        return response()->json('Post borrado');
    }
}
