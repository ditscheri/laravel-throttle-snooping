<?php

namespace Ditscheri\ThrottleSnooping;

use Ditscheri\ThrottleSnooping\Http\Middleware\ThrottleSnoopingMiddleware;
use Illuminate\Contracts\Http\Kernel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ThrottleSnoopingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-throttle-snooping')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        $kernel = $this->app->make(Kernel::class);

        foreach (config('throttle-snooping.middleware', []) as $middlewareGroup) {
            $kernel->prependMiddlewareToGroup($middlewareGroup, ThrottleSnoopingMiddleware::class);
        }
    }
}
