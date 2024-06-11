<?php

namespace App\Http\Middleware;
use App\Models\User;

use Closure;
use Illuminate\Http\Request;

class CheckSubscription
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
       
        if(!$request->session()->has("email") ){
            return redirect()->route('login');

        }
        $email = $request->session()->get('email');
       

        $user = User::with(['subscriptions'])
        ->where('email', $email)
        ->first();

        //dd($user->subscriptions->id_type);
        
        if ($user) {
          
            if (($user->subscriptions && $user->subscriptions->id_type !=1 )||$user->role==='ADMIN') {
             
                return $next($request);
            } else {
                
                return redirect()->route('profile')->with('error', 'Change your subscription to see the video!');;
            }
        } else {
            
            return redirect()->route('login');
        }
        

      
    }
}
