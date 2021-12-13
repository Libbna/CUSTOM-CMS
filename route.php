<?php
require_once 'vendor/autoload.php';
require_once './twigtemplate.php';

use Cms\Controllers\Contact;
use Cms\Controllers\Home;
use Cms\Controllers\Test;

$a = new Test();


use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


try {
    $routes = new RouteCollection();
    $context = new RequestContext();
    $home_route = new Route('/home', ['controller' => "Cms\Controllers\Home::getData"]);
    $contact_route = new Route('/contact', array('controller' => "Cms\Controllers\Contact::fetchUser"));
    
    $foo_placeholder_route = new Route(
        '/foo/{id}',
        array('controller' => 'Home::getData'),
        array('id' => '[0-9]+')
    );
    
    $routes->add('home_route', $home_route);
    $routes->add('contact_route', $contact_route);
    $routes->add('foo_route', $foo_placeholder_route);
    
    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);
    // var_dump($context->getPathInfo());
    // var_dump($context);
    $parameters = $matcher->match($context->getPathInfo());
    // die("hello");

    list($controllerClassName, $action) = explode('::', $parameters['controller']);
    // die($a->hello());
    $controller = new $controllerClassName();
    // $controller = new Test();
    $controller->{$action}($twig);

    exit;
} catch (ResourceNotFoundException $e) {
    echo $twig->render('error.html.twig', ['message' => $e->getMessage()]);
}
