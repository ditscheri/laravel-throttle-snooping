<?php

namespace Ditscheri\ThrottleSnooping\Tests;

use Ditscheri\ThrottleSnooping\ThrottleSnoopingServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ThrottleSnoopingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // $app['config']->set('database.default', 'sqlite');
    }
}
