<?php

namespace App\Http\Middleware;

use Closure;

use App\Model\SystemMode;

class CheckSystemMode
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
        $mode = SystemMode::where('systemmode_id', 1)->first();

        if(empty($mode) || $mode->run == 1){
            return redirect('/');
        }


        return $next($request);
    }
}
