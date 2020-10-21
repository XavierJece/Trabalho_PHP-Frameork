<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\UserDAO;
use Firebase\JWT\JWT;

final class AuthController
{
    public function login(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $email = $data['email'];
        $password = $data['password'];

        $userDAO = new UserDAO();
        $user = $userDAO->getByEmail($email);

        if (is_null($user)) {
            return $response->withStatus(401)->withJson(['error' => 'Usuário não encontrado!']);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $response->withStatus(401)->withJson(['error' => 'Email ou senha inválidos!']);
        }

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'expiredAt' => ((new \DateTime())->modify('+2 day'))->format('Y-m-d H:i:s'),
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

        $response = $response->withJson([
            "user" => [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "name" => $user->getName(),
                "avatar" =>$user->getAvatar()
            ],
            "token" => $token

        ]);

        return $response;
    }
}
