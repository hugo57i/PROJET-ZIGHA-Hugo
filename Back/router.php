<?php

use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\OrderController;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Middlewares\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;

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
    $app->get('/catalogue', ProductController::class . ":getAllProducts");
    $app->post('/validateOrder', OrderController::class . ":validateOrder");

    $options = [
        "attribute" => "token",
        "header" => "Authorization",
        "regexp" => "/Bearer\s+(.*)$/i",
        "secure" => false,
        "algorithm" => ["HS256"],
        "secret" => $_ENV['JWT_SECRET'],
        "path" => ["/"],
        "ignore" => ["/users/register","/users/login", "/catalogue"],
        "error" => function ($response, $arguments) {
            $data = array('ERREUR' => 'Connexion', 'ERREUR' => 'JWT Non valide');
            $response = $response->withStatus(401);
            return $response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($data));
        }
    ];

    $app->add(new JwtAuthentication($options));

};

