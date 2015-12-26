<?php

namespace App\Http\Middleware;

use Closure;
use \Session;
use \Request;
use \Redirect;

class RoleMiddleware
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
        # get the role,
        $features = Session::get('features');

        # get the second segment of the routes.
        $module = Request::segment(2);

        //this is to protect the unauthorize user from accessing via routes.
        if(!isset($features[$module])) abort(403, 'Unauthorized action.');

        return $next($request);
    }
}
