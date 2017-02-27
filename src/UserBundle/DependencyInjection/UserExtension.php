<?php

namespace UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UserExtension extends Extension
{
    private $container;
    private $configs;

    public function load(array $configs, ContainerBuilder $container)
    {
        $this->container = $container;
        $this->configs = $configs;

        $this->loadAppServices();
    }

    private function loadAppServices()
    {
        $loader = new YamlFileLoader(
            $this->container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yml');
    }
}
