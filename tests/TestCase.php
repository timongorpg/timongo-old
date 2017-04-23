<?php

use Mockery;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * Create a mock object to the referred class
     *
     * @param $class
     *
     * @return Mockery\MockInterface
     */
    public function mock($class)
    {
        $mockObject = Mockery::mock($class);

        $this->app->instance($class, $mockObject);

        return $mockObject;
    }
}
