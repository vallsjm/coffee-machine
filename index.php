#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Core\Infraestructure\Command\MakeDrinkCommand;
use Core\Infraestructure\Command\OrderResumeCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/config'));
$loader->load('services.yaml');
$loader->load('repositories.yaml');

$application = new Application();

$application->add(new MakeDrinkCommand($containerBuilder));
$application->add(new OrderResumeCommand($containerBuilder));

$application->run();
