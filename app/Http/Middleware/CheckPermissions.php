<?php
namespace App\Http\Middleware;
use Closure;

class CheckPermissions
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
        if (!$request->ajax()) {
           return auth()->user()->hasPermissionForRoute($request->route())
            ? $next($request) :  response("You don't have access to the requested page.");
        }

        return auth()->user()->hasPermissionForRoute($request->route())
            ? $next($request)
            : response()->json(['permitted' => false, 'msg' => "You don't have access to the requested page."]);
    }
}