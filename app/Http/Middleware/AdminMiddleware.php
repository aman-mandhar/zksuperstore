<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
     /**
     * USER ROLES
     * 0-Customer
     * 1-Admin
     * 2-Store
     * 3-Warehouse
     * 4-Sub-Warehouse
     * 5-Employee
     * 6-Merchant
     */

     public function handle(Request $request, Closure $next): Response
     {
         if(Auth::user()->user_role != '1')
         {
             return redirect('/')->with('status','Access Denied');   
         }
     return $next($request);
     }
}
