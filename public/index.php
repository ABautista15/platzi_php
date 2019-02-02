<?php
    ini_set('display_erros',1);
    ini_set('display_startup_error',1);
    error_reporting(E_ALL);

    require_once '../vendor/autoload.php';

    use Illuminate\Database\Capsule\Manager as Capsule;
    use Aura\Router\RouterContainer;
    // use App\Models\Job;

    $capsule = new Capsule;
    

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'cursophp',
        'username'  => 'root',
        'password'  => 'root',
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

    $map->get('index', '/platzi_php/', [
        'controller' => 'App\Controllers\IndexController',
        'action' => 'indexAction'
    ]);

    $map->get('addJobs', '/platzi_php/jobs/add', '../addJob.php');

    $matcher = $routerContainer->getMatcher();

    $route = $matcher->match($request);

    if(!$route){
        echo "No route";
    }else{
        $controller = $route->handler['controller'];
        $action = $route->handler['action'];

        $controller = new $controller;
        $controller->$action();
        
    }