<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();
      return view("admin.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view("admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validation
      $request->validate([
        "title" => "required|string|max:100",
        "content" => "required|string",
        "published" => "sometimes|accepted"
      ]);
      // create
      $data = $request->all();
      
      $newPost = New Post;
      $newPost->title = $data["title"];
      

      $slug = Str::of($newPost->title)->slug("-");
      $counter = 1;
      while(Post::where("slug", $slug)->first()) {
        $slug .= "-$counter";
        $counter++;
      }
      $newPost->slug = $slug;

      $newPost->content = $data["content"];
      $newPost->posted = isset($data["posted"]);

      $newPost->save();
      // redirect
      return redirect()->route("posts.show", $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view("admin.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      return view("admin.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
         // validation
        $request->validate([
          "title" => "required|string|max:100",
          "content" => "required|string",
          "published" => "sometimes|accepted"
        ]);
        // create
        $data = $request->all();
        
        // se cambia il titolo lo aggiorno
        if($data["title"] != $post->title){
          $post->title = $data["title"];
          $slug = Str::of($post->title)->slug("-");
          $counter = 1;
          while(Post::where("slug", $slug)->first()) {
            $slug .= "-$counter";
            $counter++;
          }
          $post->slug = $slug;
        }
  
        $post->content = $data["content"];
        $post->posted = isset($data["posted"]);
  
        $post->save();
        // redirect
        return redirect()->route("posts.show", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $post->delete();
      return redirect()->route("posts.index");
    }
}
