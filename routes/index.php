<?php

use function src\{
    slimConfiguration,
    jwtAuth
};

use App\Controllers\{
    PostController,
    LojaController,
    AuthController,
    ExceptionController
};

$app = new \Slim\App(slimConfiguration());

// =========================================

$app->get('/', function () {
    echo 'oi';
});

$app->post('/login', AuthController::class . ':login');


$app->get('/posts', PostController::class . ':index');


$app->group('', function () use ($app) {
    $app->post('/posts', PostController::class . ':create');
})->add(jwtAuth());

// =========================================

$app->run();
