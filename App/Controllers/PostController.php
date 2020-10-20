<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\PostDAO;
use App\DAO\MySQL\DoubtNo\UserDAO;
use App\Models\MySQL\DoubtNo\PostModel;

final class PostController
{
    public function index(Request $request, Response $response, array $args): Response
    {
        try{
            $postDAO = new PostDAO();
            $posts = $postDAO->getAll();
            $response = $response->withJson($posts);

            return $response;
        }catch(\Exception | \Throwable $ex) {
            return $response->withJson([
                'error' => \Exception::class,
                'status' => 500,
                'code' => '001',
                'userMessage' => "Erro na aplicação, entre em contato com o administrador do sistema.",
                'developerMessage' => $ex->getMessage()
            ], 500);
        }
    }

    public function create(Request $request, Response $response, array $args): Response
    {
        $userId = $request->getAttribute('userId');
        $data = $request->getParsedBody();

        $userDAO = new UserDAO();
        $user = $userDAO->getById($userId);

        if (is_null($user)) {
            return $response->withStatus(401);
        }

        $post = new PostModel($data['doubt'], $user);
        $postDAO = new PostDAO();
        $postDAO->insert($post);

        $response = $response->withJson([
            "id" => $post->getId(),
            "doubt" => $post->getDoubt(),
            "date" => $post->getDate(),
            "user" => [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "name" => $user->getName(),
                "avatar" =>$user->getAvatar()
            ]
        ]);

        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        return $response;
    }
}
