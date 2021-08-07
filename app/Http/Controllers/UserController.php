<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
  use ValidatesRequests;
  protected   $validate = [
                  'name' => ['required', 'string', 'max:255'],
                  'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                  'password' => ['required', 'string', 'min:8', 'confirmed'],];
  public function __construct()
  {
      $this->middleware('auth');
  }
//////////////////////////////////////////////////////
  public function index()
  {
      $users = User::all();
      $user = User::findOrFail(Auth::id());
      $friends =$user->friends;
      return view('user.index')->with('users',$users)->with('friends',$friends);
  }

/////////////////////////////////////////////////////
  public function show($id){
    $user = User::findOrFail($id);
    return view('users.index')->with('user',$user);

  }
/////////////////////////////////////////////////////
  public function edit($id){
    $post = Post::findOrFail($id);
    return view('post.edit')->with('post',$post);

  }
////////////////////////////////////////////////////
  public function update(Request $request,$id){
    $this->validate($request,$this->validate);
    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    session()->flash('success','Update Successfuly ');
    return redirect()->route('users.index');
  }
////////////////////////////////////////////////////
  public function destroy($id){
    $user = User::findOrFail($id);
  }
  //////////////////////////////////////////////////////
  /*
  *to make user follow others
  *take other user id
  */
  public function follow($id){
    $user = User::findOrFail(Auth::id());
    $user->friends()->attach($id);
    session()->flash('success','follow Successfuly ');
    return redirect()->route('users.index');
  }
  /////////////////////////////////////////////////////
}
