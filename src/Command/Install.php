<?php

declare(strict_types=1);

namespace SebastianFeldmann\Composer\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Composer\Command\BaseCommand;

class Install extends BaseCommand
{
    protected function configure()
    {
        $this->setName('captainhook:install');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Installing hooks');
    }
}
