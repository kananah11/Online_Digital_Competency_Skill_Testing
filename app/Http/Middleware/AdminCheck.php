<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
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
        $user = $request->user();
        if ($user && 1 == $user->admin) {
            return $next($request);
        }
        return redirect()->route('takeexam.index')->with('errors', "คุณไม่มีสิทธิเข้าถึงหน้านี้");

    }
}
