<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $minAge
     * @return mixed
     */
   
     public function handle(Request $request, Closure $next, $minAge = 18)
     {
         $age = $request->query('age'); 
 
         // If the age is less than the minimum age, redirect to access denied
         if ($age < $minAge) {
             return redirect('/access-denied');
         }
         
         // If the age is 18 or older, let the request continue to home page
         if ($age < 21) {
            return redirect('/');
         }
         // If age is 21 or older contineu to home page
         return redirect('/');
     }
 }