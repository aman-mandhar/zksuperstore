<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class WarehouseMiddleware
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
     */

     public function handle(Request $request, Closure $next): Response
     {
         if(Auth::user()->user_role != '3')
         {
             return redirect('/home')->with('status','Access Denied');   
         }
     return $next($request);
     }
}
