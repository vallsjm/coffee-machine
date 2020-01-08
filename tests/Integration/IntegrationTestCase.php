<?php

namespace Deliverea\CoffeeMachine\Tests\Integration;

use Deliverea\CoffeeMachine\Console\MysqlPdoClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class IntegrationTestCase extends TestCase
{
    /** @var Application */
    protected $application;

    protected function setUp()
    {
        parent::setUp();

        $this->application = new Application();
    }

    protected function tearDown()
    {

        parent::tearDown();
    }
}
