<?php

namespace Ditscheri\ThrottleSnooping\Tests;

use Ditscheri\ThrottleSnooping\Http\Middleware\ThrottleSnoopingMiddleware;
use Ditscheri\ThrottleSnooping\SnoopingRateLimiter;
use Exception;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Throwable;

class ThrottleSnoopingMiddlewareTest extends TestCase
{
    /**
     * @test
     * @dataProvider snoopingStatusCodes
     * */
    public function it_increments_attempts_for_listed_codes($statusCode)
    {
        $request = new Request();
        $this->callMiddleware($request, $statusCode);
        $this->assertSame(1, app(SnoopingRateLimiter::class)->attempts($request));
    }

    public function snoopingStatusCodes()
    {
        return [
            [401],
            [403],
            [404],
        ];
    }

    /**
     * @test
     * @dataProvider friendlyStatusCodes
     * */
    public function it_does_not_increment_attempts_for_other_codes($statusCode)
    {
        $request = new Request();
        $this->callMiddleware($request, $statusCode);
        $this->assertSame(0, app(SnoopingRateLimiter::class)->attempts($request));
    }

    public function friendlyStatusCodes()
    {
        return [
            [200],
            [419],
            [500],
        ];
    }

    /** @test */
    public function it_prevents_execution_when_blocked()
    {
        $request = new Request();
        for ($i = 0; $i < 6; $i++) {
            app(SnoopingRateLimiter::class)->increment($request);
        }

        $middleware = new ThrottleSnoopingMiddleware();

        $this->expectException(ThrottleRequestsException::class);

        try {
            $middleware->handle($request, function () {
                throw new Exception('This should never be executed.');
            });
        } catch (Throwable $e) {
            $this->assertInstanceOf(ThrottleRequestsException::class, $e);
            $this->assertEquals(429, $e->getStatusCode());

            throw $e;
        }
    }

    protected function callMiddleware($request, $statusCode)
    {
        $middleware = new ThrottleSnoopingMiddleware();

        try {
            $middleware->handle($request, fn () => response()->noContent($statusCode));
        } catch (\Exception $e) {
            //
        }
    }
}
