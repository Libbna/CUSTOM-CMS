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
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


try {
    $routes = new RouteCollection();
    $context = new RequestContext();

    $home_route = new Route("/custom_cms/home", ['controller' => "Home::getData"]);
    $contact_route = new Route("/custom_cms/contact", array('controller' => "Contacts::fetchUser"));

    $foo_placeholder_route = new Route(
        '/custom_cms/foo/{id}',
        array('controller' => 'Home::getData'),
        array('id' => '[0-9]+')
    );

    $routes->add('home_route', $home_route);
    $routes->add('contact_route', $contact_route);
    $routes->add('foo_route', $foo_placeholder_route);

    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());

    list($controllerClassName, $action) = explode('::', $parameters['controller']);
    $controller = new $controllerClassName();
    $controller->{$action}($twig);

    exit;
} catch (ResourceNotFoundException $e) {
    echo $e->getMessage();
}
