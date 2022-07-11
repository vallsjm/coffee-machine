<?php

namespace Core\Infraestructure\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Helper\Table;

class OrderResumeCommand extends Command
{
    protected static $defaultName = 'app:order-resume';
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Return the money earned');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $serviceMachine = $this->container->get('core.service.machine');
            $table = new Table($output);
            $table
                ->setHeaders(['DRINK', 'MONEY'])
                ->setRows($serviceMachine->resume())
            ;
            $table->render();
        } catch (\Throwable $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
