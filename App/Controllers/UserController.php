<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\PostDAO;
use App\DAO\MySQL\DoubtNo\UserDAO;
use App\Models\MySQL\DoubtNo\PostModel;

final class UserController
{
    public function create(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        return $response;
    }
}
