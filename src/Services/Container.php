<?php

namespace Cms\Services;

require_once './vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Container
{

    public function service()
    {
        // init service container
        $containerBuilder = new ContainerBuilder();

        // add service into the service container
        $containerBuilder->register('demo.service', '\Cms\Services\DemoService');

        // fetch service from the service container
        $demoService = $containerBuilder->get('demo.service');
        return $demoService;
    }

    public function yaml_service()
    {
        // init service container
        $containerBuilder = new ContainerBuilder();

        // init yaml file loader
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));

        // load services from the yaml file
        $loader->load('services.yaml');

        // fetch service from the service container
        $serviceOne = $containerBuilder->get('demo.service');
        return $serviceOne;
    }
}
