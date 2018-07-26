<?php

namespace App\Http\Middleware;

use Closure;

class ValidateUser
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
        if ($request->session()->has('user')) {
            //
            // $request->session()->put('user', [
            //     'user_id' => 2,
            //     'role_id' => 2,
            // ]);
        } else {
            return redirect()->route('login');
        }
        //echo "<pre>"; print_r($request->session()->get('user')); echo "</pre>"; exit();
        return $next($request);
    }
}
