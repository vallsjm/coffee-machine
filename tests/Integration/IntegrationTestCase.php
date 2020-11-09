<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class IntegrationTestCase extends TestCase
{
    /** @var Application */
    protected $application;
    protected $container;

    protected function setUp()
    {
        parent::setUp();

        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('parameters_test.yaml');
        $loader->load('services.yaml');
        $loader->load('repositories.yaml');

        $this->container = $container;

        $this->application = new Application();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
