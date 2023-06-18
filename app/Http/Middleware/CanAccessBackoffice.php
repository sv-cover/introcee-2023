<?php

namespace App\Http\Middleware;

use App\CoverApi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessBackoffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $coverApi = app(CoverApi::class);
        if(!$coverApi->cover_session_logged_in()) {
            return redirect($coverApi->cover_login_url($request->url()));
        } else if(!($coverApi->cover_session_in_committee('introcee') || $coverApi->cover_session_in_committee('board') || $coverApi->cover_session_in_committee('candy'))) {
            return response('<h1>no.</h1>');
        }
        return $next($request);
    }
}
