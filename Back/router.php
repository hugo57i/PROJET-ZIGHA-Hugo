<?php

use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Middlewares\CorsMiddleware;

return function(App $app){

    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        return $response;
    });
    $app->add(CorsMiddleware::class);

    $app->get('/', HomeController::class . ":home");
    $app->group('/users', function (Group $group) {
        $group->post('/login', UserController::class . ":login");
        $group->post('/register', UserController::class . ":register");
    });

};

