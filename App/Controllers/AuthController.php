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
            return $response->withStatus(401);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $response->withStatus(401);
        }

        $tokenPayload = [
            'sub' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'exp' => (new \DateTime())->getTimestamp()
        ];

        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

        $response = $response->withJson([
            "token" => $token,
            "user" => [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "name" => $user->getName(),
                "avatar" =>$user->getAvatar()
            ]
        ]);

        return $response;
    }
}
