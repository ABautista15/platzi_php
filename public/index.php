<?php
    ini_set('display_erros',1);
    ini_set('display_startup_error',1);
    error_reporting(E_ALL);

    require_once '../vendor/autoload.php';

    session_start();

    use Illuminate\Database\Capsule\Manager as Capsule;
    use Aura\Router\RouterContainer;
    // use App\Models\Job;

    $capsule = new Capsule;
    

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'cursophp',
        'username'  => 'homestead',
        'password'  => 'secret',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
    $capsule->setAsGlobal();//tenerla global
    $capsule->bootEloquent();//inicializar el orm

    $request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    );

    $routerContainer = new RouterContainer();
    $map = $routerContainer->getMap();
    
    $map->get('index', '/', [
        'controller' => 'App\Controllers\IndexController',
        'action' => 'indexAction'
    ]);

    $map->get('addJobs', '/jobs/add', [
        'controller' => 'App\Controllers\JobsController',
        'action' => 'addJobAction'
    ]);

    $map->get('addUsers', '/users/add', [
        'controller' => 'App\Controllers\UsersController',
        'action' => 'getAddUser'
    ]);
    
    $map->get('admin', '/admin', [
        'controller' => 'App\Controllers\AdminController',
        'action' => 'getIndex',
    ]);

    $map->post('saveJobs', '/jobs/add', [
        'controller' => 'App\Controllers\JobsController',
        'action' => 'addJobAction'
    ]);

    $map->post('saveUsers', '/users/save', [
        'controller' => 'App\Controllers\UsersController',
        'action' => 'postSaveUser'
    ]);

    $map->get('loginForm', '/login', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogin'
    ]);

    $map->get('logout', '/logout', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogout'
    ]);

    $map->post('auth', '/auth', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'postLogin'
    ]);
    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if(!$route){
        echo "No route";
    }else{
        $controller = $route->handler['controller'];
        $action = $route->handler['action'];
        $needsAuth = $route->handler['auth'] ?? false;
        $sessionUserId = $_SESSION['userId'] ?? null;

        if($needsAuth && !$sessionUserId){
            $controller = 'App\Controllers\AuthController';
            $action = 'getLogin';
        }

        $controller = new $controller;
        $response = $controller->$action($request);
        

        foreach($response->getHeaders() as $name => $values){
            foreach($values as $value){
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }