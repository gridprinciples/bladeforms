<?php

namespace GridPrinciples\BladeForms\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use GridPrinciples\BladeForms\BladeFormsServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

class TestCase extends Orchestra
{
    use InteractsWithViews;
    use Concerns\ValidatesHTML;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeFormsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
    }
}
