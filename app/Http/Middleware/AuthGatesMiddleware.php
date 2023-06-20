<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AuthGatesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user=Auth::user();
        if($user){
            $permissions=Permission::all();
            foreach($permissions as $key =>$permission){
                Gate::define($permission->permission_slug,function(User $user) use($permission){
                    return $user->haspermission($permission->permission_slug);
                });
            }
        }
        return $next($request);
    }
}
