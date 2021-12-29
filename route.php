<?php
require_once 'vendor/autoload.php';
require_once './twigtemplate.php';

use Cms\Controllers\Contact;
use Cms\Controllers\Home;
use Cms\Controllers\CustomBlock;
use Cms\Controllers\Db_auth;
use Cms\Controllers\Article;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


try {
    $routes = new RouteCollection();
    $context = new RequestContext();

    //creating routes

    // Home route
    $home_route = new Route('/home', ['controller' => "Cms\Controllers\Article::fetchAllArticles"]);

    // contact insert route
    $contact_insert_route = new Route('/home-contact-insert', ['controller' => "Cms\Controllers\Contact::insertUser"]);

    // contact display route
    $contact_route = new Route('/contact', array('controller' => "Cms\Controllers\Contact::fetchUser"));

    // block-form display route
    $block_route = new Route('/block-form', ['controller' => "Cms\Controllers\CustomBlock::displayForm"]);

    // blocks display route
    $block_info_route = new Route('/block-info', ['controller' => "Cms\Controllers\CustomBlock::displayCustomBlock"]);

    // block insert route
    $block_insert_route = new Route('/block-insert', ['controller' => "Cms\Controllers\CustomBlock::insertCustomBlock"]);

    // register-form display route
    $register_form_route = new Route('/register', ['controller' => "Cms\Controllers\Db_auth::getRegisterForm"]);

    // register-insert route
    $registerInsert_form_route = new Route('/register-insert', ['controller' => "Cms\Controllers\Db_auth::userRegistration"]);

    // login-form display route
    $login_form_route = new Route('/login', ['controller' => "Cms\Controllers\Db_auth::getLoginForm"]);

    // login-insert route
    $login_insert_form_route = new Route('/login-insert', ['controller' => "Cms\Controllers\Db_auth::userAuth"]);

    // logout route
    $logout = new Route('/logout', ['controller' => "Cms\Controllers\Db_auth::logout"]);

    // user-auth route
    $user_auth_route = new Route('/user-auth', ['controller' => "Cms\Controllers\Db_auth::userAuth"]);

    // Article form route
    $article_form_route = new Route('/articleForm', ['controller' => "Cms\Controllers\Article::getArticleForm"]);
    $article_insert_route = new Route('/article-insert', ['controller' => "Cms\Controllers\Article::insertArticle"]);


    $foo_placeholder_route = new Route(
        '/foo/{id}',
        array('controller' => 'Home::getData'),
        array('id' => '[0-9]+')
    );

    
    //adding route to RouteCollection
    $routes->add('home_route', $home_route);
    $routes->add('contact_route', $contact_route);
    $routes->add('contact_insert_route',     $contact_insert_route);
    $routes->add('foo_route', $foo_placeholder_route);
    $routes->add('block_route', $block_route);
    $routes->add('block_info_route', $block_info_route);
    $routes->add('block_insert_route', $block_insert_route);
    $routes->add('user_auth_route', $user_auth_route);
    $routes->add('register_form_route', $register_form_route);
    $routes->add('registerInsert_form_route', $registerInsert_form_route);
    $routes->add('login_insert_form_route', $login_insert_form_route);
    $routes->add('login_form_route', $login_form_route);
    $routes->add('logout', $logout);


    $routes->add('article_form_route', $article_form_route);
    $routes->add('article_insert_route', $article_insert_route);
    

    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);
    
    //matching routes with the url
    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);

    $parameters = $matcher->match($context->getPathInfo());

    //calling the controller
    list($controllerClassName, $action) = explode('::', $parameters['controller']);
    $controller = new $controllerClassName();
    $controller->{$action}($twig);

    exit;
} catch (ResourceNotFoundException $e) {
    echo $twig->render('error.html.twig', ['message' => $e->getMessage()]);
}
