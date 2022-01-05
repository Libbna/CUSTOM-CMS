<?php
require_once 'vendor/autoload.php';
require_once './twigtemplate.php';

use Cms\Controllers\Contact;
use Cms\Controllers\Home;
use Cms\Controllers\CustomBlock;
use Cms\Controllers\Db_auth;
use Cms\Controllers\Article;
use Cms\Controllers\Menu;
use Cms\Controllers\Admin;

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

    $root_route = new Route('/', ['controller' => "Cms\Controllers\Article::fetchAllArticles"]);

    // Home route
    $home_route = new Route('/home', ['controller' => "Cms\Controllers\Article::fetchAllArticles"]);

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

    // menu-form display route
    $menu_route = new Route('/menu-form', ['controller' => "Cms\Controllers\Menu::displayMenuForm"]);

    // menus display route
    $menu_info_route = new Route('/menu-info', ['controller' => "Cms\Controllers\Menu::displayCustomMenu"]);

    // menu insert route
    $menu_insert_route = new Route('/menu-insert', ['controller' => "Cms\Controllers\Menu::insertCustomMenu"]);

    //users display route
    $user_info_route = new Route('/user-info', ['controller' => "Cms\Controllers\Admin::displayUserDetails"]);


    $foo_placeholder_route = new Route(
        '/foo/{id}',
        array('controller' => 'Home::getData'),
        array('id' => '[0-9]+')
    );
  
    $delete_route = new Route(
        '/delete/id/{id}',
        array('controller' => 'Cms\Controllers\Admin::userDelete'),
        array('id' => '[0-9]+')
    );
  
    // Admin related
    $admin_role_route = new Route(
        '/update-role/{id}',
        array('controller' => 'Cms\Controllers\Admin::updateUserRoleToAdmin'),
        array('id' => '[0-9]+')
    );

    $authenticated_role_route = new Route(
        '/remove-role/{id}',
        array('controller' => 'Cms\Controllers\Admin::updateUserRoleToAuth'),
        array('id' => '[0-9]+')
    );

    // Aritcle related
    $article_content_route = new Route(
        "/article/{id}",
        array('controller' => 'Cms\Controllers\Article::fetchAllArticles'),
        array('id' => '[0-9]+')
    );

    //adding route to RouteCollection
    $routes->add('root_route', $root_route);
    $routes->add('home_route', $home_route);
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
    $routes->add('menu_route', $menu_route);
    $routes->add('menu_info_route', $menu_info_route);
    $routes->add('menu_insert_route', $menu_insert_route);
    $routes->add('article_form_route', $article_form_route);
    $routes->add('article_insert_route', $article_insert_route);
    $routes->add('user_info_route', $user_info_route);
    $routes->add('delete_route', $delete_route);
    

    $routes->add('admin_role_route', $admin_role_route);
    $routes->add('authenticated_role_route', $authenticated_role_route);

    $routes->add('article_content_route', $article_content_route);

    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);

    //matching routes with the url
    $context->fromRequest(Request::createFromGlobals());
    $matcher = new UrlMatcher($routes, $context);

    $parameters = $matcher->match($context->getPathInfo());

    //calling the controller
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
} catch (ResourceNotFoundException $e) {
    echo $twig->render('error.html.twig', ['message' => $e->getMessage()]);
}
