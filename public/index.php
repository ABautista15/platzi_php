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
    
  
    
    function printJob($job){
      
        echo '<li class="work-position">';
        echo '<h5>'.$job->title.'</h5>';
        echo '<p>'.$job->description.'</p>';
        
        echo '<strong>Achievements:</strong>';
        echo '<ul>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
        echo '</ul>';
        echo '</li>';
      
    }
    $map->get('index', '/platzi_php/', [
        'controller' => 'App\Controllers\IndexController',
        'action' => 'indexAction'
    ]);

    $map->get('addJobs', '/platzi_php/jobs/add', [
        'controller' => 'App\Controllers\JobsController',
        'action' => 'addJobAction'
    ]);

    $map->get('addUsers', '/platzi_php/users/add', [
        'controller' => 'App\Controllers\UsersController',
        'action' => 'getAddUser'
    ]);

    $map->post('saveJobs', '/platzi_php/jobs/add', [
        'controller' => 'App\Controllers\JobsController',
        'action' => 'addJobAction'
    ]);

    $map->post('saveUsers', '/platzi_php/users/save', [
        'controller' => 'App\Controllers\UsersController',
        'action' => 'postSaveUser'
    ]);

    $map->get('loginForm', '/platzi_php/login', [
        'controller' => 'App\Controllers\AuthController',
        'action' => 'getLogin'
    ]);

    $map->post('auth', '/platzi_php/auth', [
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