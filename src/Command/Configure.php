<?php

declare(strict_types=1);

namespace SebastianFeldmann\Composer\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Composer\Command\BaseCommand;

class Configure extends BaseCommand
{
    protected function configure()
    {
        $this->setName('captainhook:configure');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Configuring hooks');
    }
}
