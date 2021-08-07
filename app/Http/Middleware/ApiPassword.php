<?php
/* this middleware for chech apps that will use api route not user
by make api password that apps use it when use api for my site
*/
namespace App\Http\Middleware;
use Closure;
class ApiPassword
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
      if ($request->api_password !== env("API_PASSWORD",'EIuU70poYG45lddW92TzE4hiZ')) {
        return response()->json(['message'=>'Unauthenticated !.']);
      }
      return $next($request);
    }
}
