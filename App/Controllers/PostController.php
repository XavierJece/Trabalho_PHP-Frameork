<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\PostDAO;

final class PostController
{
    public function index(Request $request, Response $response, array $args): Response
    {
        $queryParams = $request->getQueryParams();

        $postDAO = new PostDAO();
        $posts = $postDAO->getAll();
        $response = $response->withJson($posts);

        return $response;
    }

    public function insert(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        return $response;
    }
}
