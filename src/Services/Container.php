<?php

namespace Cms\Services;

require_once './vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * {@inheritdoc}
 */
class Container {

  /**
   * {@inheritdoc}
   */
  public function service() {
    // Init service container.
    $containerBuilder = new ContainerBuilder();

    // Add service into the service container.
    $containerBuilder->register('demo.service', '\Cms\Services\DemoService');

    // Fetch service from the service container.
    $demoService = $containerBuilder->get('demo.service');
    return $demoService;
  }

  /**
   * {@inheritdoc}
   */
  public function yamlService($service) {
    // Init service container.
    $containerBuilder = new ContainerBuilder();

    // Init yaml file loader.
    $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));

    // Load services from the yaml file.
    $loader->load('services.yaml');

    // Fetch service from the service container.
    $serviceOne = $containerBuilder->get($service);
    return $serviceOne;
  }

}
