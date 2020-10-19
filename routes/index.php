<?php

use function src\{
    slimConfiguration,
};

use App\Controllers\{
    ProdutoController,
    LojaController,
    AuthController,
    ExceptionController
};

$app = new \Slim\App(slimConfiguration());

// =========================================

$app->get('/', function () {
    echo 'oi';
});


// =========================================

$app->run();
