<?php

namespace App\Http\Middleware;

use App\Traits\Tools\Resource;
use Closure;
use Illuminate\Support\Facades\View;

class StaticResource
{
    use Resource;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share([
            'jsPath' => $this->getJsPath(),
            'cssPath' => $this->getCssPath()
        ]);

        return $next($request);
    }
}
