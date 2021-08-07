<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
class AuthController extends BaseController
{
  /**
  *function to make login take two param email and password
   *in error status take two param error number and message
  * @return response with JWT token in json object
  */
  public function login(Request $request){
     $validator= Validator::make($request->all(), [
          'email' => ['required', 'string', 'email', 'max:255'],
          'password' => ['required', 'string', 'min:8'],
     ]);
     if($validator->fails()){
        return $this->ReturnError($validator->errors(),"400");
     }
     $creds=$request->only(['email','password']);
     if (!$token=JWTAuth::attempt($creds)) {
       return $this->ReturnError("invalid email or password","400");
     }
     return $this->ReturnData('token',$token);
  }
  //////////////////////////////////////////////////////////////////////////////////////
  /**
  *function to make register
   *in error status take two param error number and message
  * @return to login method to get JWT token in json object
  */
  public function register(Request $request){
        $validator=Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()){
          return $this->ReturnError($validator->errors(),"400");
        }
        $user =new User;
        try{
          $user->name=$request->name;
          $user->email=$request->email;
          $user->password=Hash::make($request->password);
          $user->save();
          return $this->login($request);

        }
        catch(Exception $e){
          return $this->ReturnError(''.$e,"400");
        }
  }
  ///////////////////////////////////////////////////////////////////////////
  public function logout(Request $request){
       try{
          JWTAuth::invalidate(JWTAuth::parseToken($request->token));
          return $this->ReturnSuccess("logout success !.","201");
       }
       catch(Exception $e){
         return $this->ReturnError(''.$e,"401");
       }
    }
}
