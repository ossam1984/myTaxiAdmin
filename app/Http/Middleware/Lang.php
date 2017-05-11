<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(Application $app) {
        $this->app = $app;
    }

    
    public function handle($request, Closure $next)
    {
        $this->app->setLocale($request->segment(1));
        return $next($request);
    
    }
}
