<?php

namespace App\Http\Middleware;

use Closure;
use \Session;
use \Route;
use \Redirect;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //get the user permission
        $user_permissions = Session::get('permissions');

        $route_name = Route::currentRouteName();
        $route_name_array = explode('.', $route_name);
        $module = $route_name_array [1];
        $current_permission = end($route_name_array);

        # always allow index page access, other page access need to be determine by their route name access.
        if($current_permission == 'index') {} //do nothing
        else
        {
          if(!in_array($current_permission, $user_permissions[$module])) return Redirect::to('errors/403');
        }

        return $next($request);
    }
}
