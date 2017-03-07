<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\roles;
use DB;

class moduleMiddleware
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
        $roles = roles::find(Auth::user()->role_id);
        $lists = DB::table('modules')->whereIn('id',explode(',',$roles->module))->get();

        foreach ($lists as $list) {
           if ($request->is($list->link.'*')) {
               return $next($request);
           }
        }
        return redirect('/');
    }
}
