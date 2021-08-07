<?php

namespace App\Http\Controllers\Api;
// use App\Traits\GeneralTrait;
use App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
  protected   $validate = [
    'title' => 'required|string|max:255',
    'text' => 'required|string|max:2000'
  ];

//////////////////////////////////////////////////////
  public function index()
  {
    $posts= null;
    $all_posts = Post::all();
    if(!$all_posts || $all_posts==null)
    {
      return $this->ReturnError("no posts created yet !.",'404');
    }

    foreach($all_posts as $post){
      if(auth()->user()->can('view-post',$post))
      {
         $posts[] = $post;
      }
    }
    if($posts !== null)
    {
      return $this->ReturnData("posts",$posts);
    }
    return $this->ReturnError("no posts created yet !.",'404');

  }
////////////////////////////////////////////////////
  public function store(Request $request){
    $validator= Validator::make($request->all(), [
         'title' => ['required', 'string', 'max:255'],
         'text' => ['required', 'string', 'max:2000'],
    ]);
    if($validator->fails()){
       return $this->ReturnError($validator->errors(),"400");
    }
    $post = new Post;
    $post->user_id = Auth::id();
    $post->title = $request->title;
    $post->text = $request->text;
    $post->save();
    return $this->ReturnSuccess("your post created successfuly !.","201");

  }
/////////////////////////////////////////////////////

  public function edit(Request $request){
    $post = Post::find($request->id);
    if(!$post)
    {
      return $this->ReturnError("this post not found",'404');
    }
    if(auth()->user()->can('update-post', $post))
    {
      return $this->ReturnData("post",$post);
    }
    return $this->ReturnError("Unauthorized !",'403');


  }
////////////////////////////////////////////////////
  public function update(Request $request,$id){
    $post = Post::find($request->id);
    if(!$post)
    {
      return $this->ReturnError("this post not found !.",'404');
    }
    if(auth()->user()->can('update-post', $post)){
      $validator= Validator::make($request->all(), [
           'title' => ['required', 'string', 'max:255'],
           'text' => ['required', 'string', 'max:2000'],
      ]);
      if($validator->fails()){
         return $this->ReturnError($validator->errors(),"400");
      }
      $post->user_id = Auth::id();
      $post->title = $request->title;
      $post->text = $request->text;
      $post->save();
      return $this->ReturnSuccess("your post updated successfuly !.");
    }
    return $this->ReturnError("Unauthorized !",'403');
  }
////////////////////////////////////////////////////
  public function destroy(Request $request){
    $post = Post::find($request->id);
    if(!$post)
    {
      return $this->ReturnError("this post not found !.",'404');
    }
    if(auth()->user()->can('update-post', $post))
    {
      $post->delete();
      return $this->ReturnSuccess("your post deleted successfuly !.");

    }
    return $this->ReturnError("Unauthorized !",'403');

  }
}
