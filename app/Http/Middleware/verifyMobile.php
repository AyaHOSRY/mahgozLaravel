<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class verifyMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || 
        ($request->user() instanceof MustVerifyMobile && 
        !$request->user()->hasVerifiedMobile())){
            return response()->json([
                'message'=>'your mobile no is not verified',
                
              ],403);
          
        }

        return $next($request);
    }
}
