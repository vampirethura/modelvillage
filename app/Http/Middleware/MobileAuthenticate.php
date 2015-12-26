<?php

namespace App\Http\Middleware;

use Closure;
use \Input;
use App\MobileSession;
use \Response;

class MobileAuthenticate
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
      $session_token = Input::get('session_token');
    	$session = MobileSession::where('session_id', $session_token)->first();
    	if (!$session) {
    		return Response::json(['status' => 3, 'message' => 'Invalid user. Please login again.']);
    	}
      return $next($request);
    }
}
