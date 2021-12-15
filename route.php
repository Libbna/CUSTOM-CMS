<?php
require_once 'vendor/autoload.php';
require_once './twigtemplate.php';

use Cms\Controllers\Contact;
use Cms\Controllers\Home;
use Cms\Controllers\CustomBlock;

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
    $block_route = new Route('/block', ['controller' => "Cms\Controllers\CustomBlock::displayForm"]);
    $block_insert_route = new Route('/block/insert', ['controller' => "Cms\Controllers\CustomBlock::insertCustomBlock"]);

    $foo_placeholder_route = new Route(
        '/foo/{id}',
        array('controller' => 'Home::getData'),
        array('id' => '[0-9]+')
    );
    
    $routes->add('home_route', $home_route);
    $routes->add('contact_route', $contact_route);
    $routes->add('foo_route', $foo_placeholder_route);
    $routes->add('block_route', $block_route);
    $routes->add('block_insert_route', $block_insert_route);
    
    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);
   
    $parameters = $matcher->match($context->getPathInfo());

    list($controllerClassName, $action) = explode('::', $parameters['controller']);
    $controller = new $controllerClassName();
    $controller->{$action}($twig);

    exit;
} catch (ResourceNotFoundException $e) {
    echo $twig->render('error.html.twig', ['message' => $e->getMessage()]);
}
