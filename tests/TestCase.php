<?php

use Illuminate\Support\Facades\Schema;
use Codecourse\Roles\RolesServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get service providers.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [RolesServiceProvider::class];
    }

    /**
     * Set up for testing.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Eloquent::unguard();

        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--path' => realpath(__DIR__ . '/../../migrations'),
        ]);
    }

    /**
     * Tear down after tests.
     *
     * @return void
     */
    public function tearDown()
    {
        Schema::drop('users');
    }

    /**
     * Get up the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });
    }
}