<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;
class PostsController extends Controller
{
    public function index()
    {
      return view('posts.top');

    }

    public function bbs()
    {
      $posts = Post::with(['comments'])->orderBy('created_at', 'desc')->paginate(10);
      return view('posts.bbs',['posts'=>$posts]);
    }

    public function create()
    {
    return view('posts.create');
    }

    public function store(Request $request)
    {
    $params = $request->validate([
        'title' => 'required|max:50',
        'body' => 'required|max:2000',
    ]);

        auth()->user()->posts()->create($params);
        //Post::create($params);

    return redirect()->route('bbsTop');
    }

    public function show($post_id)
    {
      $post=Post::findOrFail($post_id);

      return view('posts.show',[
        'post'=>$post,
      ]);
    }

    public function edit($post_id)
    {

      $post=Post::findOrFail($post_id);
      $this->authorize('edit', $post);
      return view('posts.edit', [
        'post' => $post,
    ]);
    }

    public function update($post_id,Request $request)
    {
      $params=$request->validate([
    'title'=>'required|max:50',
    'body'=>'required|max:2000',
    ]);
    $post=Post::findOrFail($post_id);
    $this->authorize('update', $post);
    $post->fill($params)->save();
    return redirect()->route('posts.show',['post'=>$post]);
    }

    public function destroy($post_id)
    {
      $post=Post::findOrFail($post_id);
      $this->authorize('edit', $post);

      \DB::transaction(function() use ($post){
    $post->comments()->delete();
    $post->delete();
    });

    return redirect()->route('bbsTop');
    }


    }
