<?php

declare(strict_types=1);

namespace SebastianFeldmann\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capable;

class Plugin implements PluginInterface, EventSubscriberInterface, Capable
{
    private Composer $composer;

    private IOInterface $io;

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io       = $io;
    }

    public function getCapabilities()
    {
        return [
            'Composer\Plugin\Capability\CommandProvider' => 'SebastianFeldmann\Composer\Plugin\CommandProvider',
        ];
    }

    public function postInstall(): void
    {
        $this->io->write("postInstall is triggered");
        $this->io->write("Plugin version file: " . $this->readPluginVersion());

        print_r($this->composer->getPackage());
    }

    public function postUpdate(): void
    {
        $this->io->write("postUpdate is triggered");
        $this->io->write("Plugin version file: " . $this->readPluginVersion());
    }

    public static function getSubscribedEvents()
    {
        return [
            'post-install-cmd' => 'postInstall',
            'post-update-cmd'  => 'postUpdate',
        ];
    }

    private function readPluginVersion(): string
    {
        return trim(file_get_contents(__DIR__ . '/../version.info'));
    }
}
