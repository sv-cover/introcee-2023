<?php

namespace App\Http\Middleware;

use App\CoverApi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class CoverSessionMiddleware
{
    protected $coverApi;

    public function __construct(CoverApi $coverApi)
    {
        $this->coverApi = $coverApi;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($this->coverApi->cover_session_logged_in()) {
            app()->instance('coverapi', $this->coverApi);
        } else {
            app()->forgetInstance('coverapi');
        }
//
        return $next($request);
    }
}
