<?php

use function src\{
    slimConfiguration,
    jwtAuth
};

use App\Controllers\{
    PostController,
    AuthController,
    CommentController,
    UserController
};

$app = new \Slim\App(slimConfiguration());

// =========================================

$app->get('/', function () {
    echo 'oi';
});

$app->post('/login', AuthController::class . ':login');
$app->post('/users', UserController::class . ':create');


$app->get('/posts', PostController::class . ':index');
$app->get('/posts/{postId}', PostController::class . ':show');


$app->group('', function () use ($app) {
    $app->post('/posts', PostController::class . ':create');
    $app->post('/comments', CommentController::class . ':create');

    $app->put('/users', UserController::class . ':update');


    $app->delete('/comments/{commentId}', CommentController::class . ':delete');
})->add(jwtAuth());

// =========================================

$app->run();
