<?php

use function src\{
    slimConfiguration,
    basicAuth,
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
$app->post('/refresh-token', AuthController::class . ':refreshToken');


$app->get('/posts', PostController::class . ':index');


// $app->group('', function () use ($app) {
//     $app->get('/loja', LojaController::class . ':getLojas');
//     $app->post('/loja', LojaController::class . ':insertLoja');
//     $app->put('/loja', LojaController::class . ':updateLoja');
//     $app->delete('/loja', LojaController::class . ':deleteLoja');

//     $app->get('/produto', ProdutoController::class . ':getProdutos');
//     $app->post('/produto', ProdutoController::class . ':insertProduto');
//     $app->put('/produto', ProdutoController::class . ':updateProduto');
//     $app->delete('/produto', ProdutoController::class . ':deleteProduto');
// })->add(jwtAuth());

// =========================================

$app->run();
