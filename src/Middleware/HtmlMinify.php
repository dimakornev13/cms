<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class HtmlMinify
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
         if(
             !App::environment('production')
             || !$request->isMethod('GET')
             || stripos($request->path(), 'order/') !== false){

             return $next($request);
         }

        $response = $next($request);

        $response->setContent(preg_replace(['#\s{2,}#', '#(<!--.*-->)#U', '#>(\s+)<#U'], [' ', '', '><'], $response->getContent()));

        return $response;
    }
}
