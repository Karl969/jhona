<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Log the request details
        $logData = sprintf("[%s] %s %s", now(), $request->method(), $request->fullUrl());
        file_put_contents(storage_path('logs/log.txt'), $logData.PHP_EOL, FILE_APPEND);

        return $next($request);
    }
}
