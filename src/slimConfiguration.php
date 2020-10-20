<?php

namespace src;

use App\DAO\MySQL\DoubtNo\UserDAO;

function slimConfiguration(): \Slim\Container
{
    $configuration = [
        'settings' => [
            'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
        ],
    ];

    $container = new \Slim\Container($configuration);

    $container->offsetSet(UserDAO::class, new UserDAO());

    return $container;
}
