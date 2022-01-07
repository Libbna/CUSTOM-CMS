<?php
require_once 'vendor/autoload.php';
require_once './twigtemplate.php';

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

try
{
    // Load routes from the yaml file
    $fileLocator = new FileLocator(array(__DIR__));
    $loader = new YamlFileLoader($fileLocator);
    $routes = $loader->load('routes.yaml');
    
    // Init RequestContext object
    $context = new RequestContext();
    $context->fromRequest(Request::createFromGlobals());

    // Init UrlMatcher object
    $matcher = new UrlMatcher($routes, $context);
    // Find the current route
    $parameters = $matcher->match($context->getPathInfo());
    
    list($controllerClassName, $action) = explode('::', $parameters['controller']);
    
    if (isset($parameters['id'])) {
        $id = $parameters['id'];
        $controller = new $controllerClassName();
        $controller->{$action}($twig, $id);
    } else {
        $controller = new $controllerClassName();
        $controller->{$action}($twig);
    }

    exit;
    
}
catch (ResourceNotFoundException $e)
{
  echo $e->getMessage();
}
