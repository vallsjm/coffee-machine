#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Deliverea\CoffeeMachine\Console\MakeDrinkCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new MakeDrinkCommand());

$application->run();
