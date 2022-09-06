<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(Request $request)
    {
          $validator = Validator::make($request->all(),[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email|string',
            'password'=>'required|min:6',
            'user_type'=>'required'
          ]);
          if ($validator->fails()){
            return response()->json($validator->errors()->tojson(),400);
          }
           

          $user = User::create(array_merge(
            $validator->validated(),[
            'verified_code'=> rand(111111, 999999),
            'password'=>bcrypt($request->password),
            /*'name'=>$request->name,
            'email'=>$request->email,*/
            /*'phone'=>$request->phone,
            'user_type'=>$request->user_type,
            'image'=>$request->image,*/
            ]
        ));
       

            /*array_merge(
            $validator->validated(),['password'=>bcrypt($request->password)]
          ));*/
          return response()->json([
            'message'=>'user successfully registered',
            'user'=>$user
          ],201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'password' => 'required|string|min:6'
            
        ]);
        
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        if(!$token = auth('api')->attempt($validator->validated())){
            return response()->json(['error'=>'Unauthenticated'],401);
         }
         return $this->createNewToken($token);
    }
    public function createNewToken($token){
        $basic  = new \Nexmo\Client\Credentials\Basic('90326cf9', 'AT38wZdRJjPDuOZN');
        $client = new \Nexmo\Client($basic);
        $verified_code =rand(111111, 999999);
        $user = auth('api')->user();
        $message = $client->message()->send([
            'to' => $user->phone,
            'from' => 'laravel',
            'text' => $verified_code,
        ]);
        $user->verified_code = $verified_code;
        $user->save();
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth('api')->factory()->getTTL()*60,
            'user' => auth()->user(),
            'verified_code'=> $verified_code
        ]);
      
    }


    public function confirm(Request $request)
    {
        $user = User::where(['phone'=>$request->phone]);
        if (! $user) {
            return response()->json(['status' => 'fail','data'=> null ]);
        }elseif ($user->verified_code == $request->code) {
        return response()->json(['status' => 'success',
        'message'=>'verified code is correct man']);
       }else{
            return response()->json(['error'=>'incorrect code'],401);
     }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message'=>'successfully logged out'
        ]);
    }
}
