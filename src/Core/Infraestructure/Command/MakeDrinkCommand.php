<?php

namespace Core\Infraestructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Order a drink and output the status');

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
        try {
            $serviceMachine = $this->container->get('core.service.machine');
            $drink = $serviceMachine->payDrink(
                $input->getArgument('drink-type'),
                $input->getArgument('money')
            );

            $order = $serviceMachine->createOrder(
                $drink,
                $input->getArgument('sugars'),
                $input->getOption('extra-hot')
            );

            $output->writeln($serviceMachine->orderStatus($order));
        } catch (\Throwable $e) {
            $output->writeln($e->getMessage());
        }
    }
}
