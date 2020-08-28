<?php

declare(strict_types=1);

namespace SebastianFeldmann\Composer\Plugin;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use SebastianFeldmann\Composer\Command\Configure;
use SebastianFeldmann\Composer\Command\Install;

class CommandProvider implements CommandProviderCapability
{
    public function getCommands()
    {
        return [
            new Configure(),
            new Install(),
        ];
    }
}
