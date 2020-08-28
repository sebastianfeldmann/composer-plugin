<?php

declare(strict_types=1);

namespace SebastianFeldmann\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capable;
use http\Exception\RuntimeException;

class Plugin implements PluginInterface, EventSubscriberInterface, Capable
{
    private const NAME = 'sebastianfeldmann/composer-plugin';

    private const VERSION = '1.0.2';

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
        $this->change();
    }

    public function postUpdate(): void
    {
        $this->io->write("postUpdate is triggered");
        $this->change();
    }

    public function change(): void
    {
        $this->io->write("Plugin version constant: " . self::VERSION);
        $this->io->write("Plugin version file: " . $this->readVersionFile());
        $this->io->write("Plugin version: " . $this->detectInstalledVersion($this->composer->getLocker()));

    }

    public static function getSubscribedEvents()
    {
        return [
            'post-install-cmd' => 'postInstall',
            'post-update-cmd'  => 'postUpdate',
        ];
    }

    private function readVersionFile(): string
    {
        return trim(file_get_contents(__DIR__ . '/../version.info'));
    }

    private function detectInstalledVersion($locker)
    {
        $lockData = $locker->getLockData();
        $packages = array_merge($lockData['packages'], $lockData['packages-dev']);

        foreach ($packages as $package) {
            if ($package['name'] === self::NAME) {
                return $package['version'];
            }
        }
        throw new RuntimeException('version could not be detected');
    }
}
