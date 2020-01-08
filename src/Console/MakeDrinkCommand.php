<?php

namespace Deliverea\CoffeeMachine\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    protected function configure()
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $drinkType = strtolower($input->getArgument('drink-type'));
        if (!in_array($drinkType, ['tea', 'coffee', 'chocolate'])) {
            $output->writeln('The drink type should be tea, coffee or chocolate.');
        } else {
            /**
             * Tea       --> 0.4
             * Coffee    --> 0.5
             * Chocolate --> 0.6
             */
            $money = $input->getArgument('money');
            switch ($drinkType) {
                case 'tea':
                    if ($money < 0.4) {
                        $output->writeln('The tea costs 0.4.');
                        return;
                    }
                    break;
                case 'coffee':
                    if ($money < 0.5) {
                        $output->writeln('The coffee costs 0.5.');
                        return;
                    }
                    break;
                case 'chocolate':
                    if ($money < 0.6) {
                        $output->writeln('The chocolate costs 0.6.');
                        return;
                    }
                    break;
            }

            $sugars = $input->getArgument('sugars');
            $stick = false;
            $extraHot = $input->getOption('extra-hot');
            if ($sugars >= 0 && $sugars <= 2) {
                $output->write('You have ordered a ' . $drinkType);
                if ($extraHot) {
                    $output->write(' extra hot');
                }

                if ($sugars > 0) {
                    $stick = true;
                    if($stick) {
                        $output->write(' with ' . $sugars . ' sugars (stick included)');
                    }
                }
                $output->writeln('');
            } else {
                $output->writeln('The number of sugars should be between 0 and 2.');
            }
        }
    }
}
