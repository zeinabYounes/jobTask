<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  use ValidatesRequests;
  protected   $validate = [
    'title' => 'required|string|max:255',
    'text' => 'required|string|max:2000'
  ];
  public function __construct()
  {
      $this->middleware('auth');
  }
//////////////////////////////////////////////////////
  public function index()
  {
      $all_posts = Post::all();
      foreach($all_posts as $post){
        if(auth()->user()->can('view-post',$post))
        {
           $posts[] =$post;
        }
      }
     return view('post.index')->with('posts',$posts);
  }
//////////////////////////////////////////////////////

  public function create(){
    return view('post.create');
  }
////////////////////////////////////////////////////
  public function store(Request $request){
    $this->validate($request,$this->validate);
    $post = new Post;
    $post->user_id = Auth::id();
    $post->title = $request->title;
    $post->text = $request->text;
    $post->save();
    session()->flash('success','Creation Successfuly ');
    return redirect()->route('posts.index');
  }
/////////////////////////////////////////////////////
  // public function show(){
  //   $post = Post::findOrFail($id);
  //   return view('post.index')->with('posts',$posts);
  //
  // }
/////////////////////////////////////////////////////
  public function edit($id){
    $post = Post::findOrFail($id);
    if(auth()->user()->can('update-post', $post))
    {
      return view('post.edit')->with('post',$post);
    }
    session()->flash('fail','Un Authorized ');
    return back();


  }
////////////////////////////////////////////////////
  public function update(Request $request,$id){
    $post = Post::findOrFail($id);
    if(auth()->user()->can('update-post', $post)){
      $this->validate($request,$this->validate);
      $post->user_id = Auth::id();
      $post->title = $request->title;
      $post->text = $request->text;
      $post->save();
      session()->flash('success','Update Successfuly ');
      return redirect()->route('posts.index');
    }
    session()->flash('fail','Un Authorized ');
    return redirect()->route('posts.index');
  }
////////////////////////////////////////////////////
  public function destroy($id){
    $post = Post::findOrFail($id);
    if(auth()->user()->can('update-post', $post))
    {
      $post->delete();
      session()->flash('success','delete Successfuly ');
      return redirect()->route('posts.index');
    }
    session()->flash('fail','Un Authorized ');
    return redirect()->route('posts.index');
  }
}
