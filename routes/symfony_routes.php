<?php
require_once '../vendor/autoload.php';
require_once '../controllers/Home.php';
require_once '../controllers/Contact.php';
require_once '../twigtemplate.php';

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

try {


    $routes = new RouteCollection();
    $context = new RequestContext();

    // Create Routes
    $home_route = new Route("/home", ['controller' => "Home::getData"]);
    $contact_route = new Route("/contact", array('controller' => "Contacts::fetchUser"));

    // Add routes to collection
    $routes->add('home_route', $home_route);
    $routes->add('contact_route', $contact_route);

    // Match the incoming route
    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());

    // // // Dump the params of the route matched
    // echo '<pre>';
    // print_r($parameters);
    // var_dump($parameters);

    // Execution
    list($controllerClassName, $action) = explode('::', $parameters['controller']);
    $controller = new $controllerClassName();
    $controller->{$action}($twig);


    exit;
} catch (ResourceNotFoundException $e) {
    echo $e->getMessage($twig);
}
