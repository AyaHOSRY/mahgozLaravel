<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyMobileController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code'=>['required' , 'numeric'],

        ]);
        if($request->code === auth()->user()->verified_code){
            $request->user()->markMobileAsVerified();

             return response()->json([
                'message'=>'your mobile  is verified',
                
              ],201);
        }
        return response()->json([
            'message'=>'invaild verfication code entered',
            
          ],403);
    }
}
