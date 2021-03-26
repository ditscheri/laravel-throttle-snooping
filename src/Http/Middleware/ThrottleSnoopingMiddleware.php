<?php

namespace Ditscheri\ThrottleSnooping\Http\Middleware;

use Closure;
use Ditscheri\ThrottleSnooping\SnoopingRateLimiter;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThrottleSnoopingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $limiter = app(SnoopingRateLimiter::class);

        if ($limiter->tooManyAttempts($request)) {
            throw new ThrottleRequestsException('Too Many Attempts.');
        }

        $response = $next($request);

        if ($this->looksLikeSnooping($response)) {
            $limiter->increment($request);
        }

        return $response;
    }

    protected function looksLikeSnooping($response): bool
    {
        return $response instanceof Response
            && in_array(
                $response->status(),
                config('throttle-snooping.status_codes', [])
            );
    }
}
