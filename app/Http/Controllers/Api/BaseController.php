<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  /**
  *function to show response in error status take two param error number and message
  * @return response in json object
  */
  public function ReturnError($msg,$errorNum){
    return response()->json([
      'status'=>false,
      'errorNum'=>$errorNum,
      'msg'=>$msg
    ]);
  }
  /**
  *function to show response in successfull status
  * @return response in json object
  */
  public function ReturnSuccess($msg="",$errorNum="0000"){
    return response()->json([
      'status'=>true,
      'errorNum'=>$errorNum,
      'msg'=>$msg
    ]);
  }
  /**
  *function to show response in  successfull status with data take tree param key,value and message
  * @return data in json object
  */
  public function ReturnData($key,$value,$msg=""){
    return response()->json([
      'status'=>true,
      'errorNum'=>"0000",
      'msg'=>$msg,
      $key=>$value
    ]);
  }
}
