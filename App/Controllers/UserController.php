<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\PostDAO;
use App\DAO\MySQL\DoubtNo\UserDAO;
use App\Models\MySQL\DoubtNo\PostModel;
use App\Models\MySQL\DoubtNo\UserModel;

final class UserController
{
    public function create(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        if($data['password'] != $data['passwordConfirmation']){
            return $response->withStatus(401)->withJson(['error' =>"Senha Diferentes! Qual devo salvar?"]);
        }

        $userDAO = new UserDAO();
        $userExist = $userDAO->getByEmail($data['email']);

        if(!is_null($userExist)){
            return $response->withStatus(401)->withJson(['error' =>"Usuário já cadastrado!"]);
        }



        $user = new UserModel();
        $user->setId()
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setName($data['name']);

        $userDAO->insert($user);


        $userResponse = [
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "name" => $user->getName(),
            "avatar" => $user->getAvatar(),
        ];

        $response = $response->withJson($userResponse);

        return $response;
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $userId = $request->getAttribute('userId');
        $data = $request->getParsedBody();

        $userDAO = new UserDAO();
        $user = $userDAO->getById($userId);

        if (is_null($user)) {
            return $response->withStatus(401)->withJson(['error' => 'Usuário não existe!']);
        }

        if(isset($data['password'])) {
            if(isset($data['passwordConfirmation'])){
                if($data['password'] != $data['passwordConfirmation']){
                    return $response->withStatus(401)->withJson(['error' =>"Senha Diferentes! Qual devo salvar?"]);
                }else{
                    $user->setPassword($data['password']);
                }
            }else{
                return $response->withStatus(401)->withJson(['error' =>"Precisa enviar o 'passwordConfirmation'"]);
            }
        }

        if(isset($data['email'])){
            $userExist = $userDAO->getByEmail($data['email']);

            if(
                !is_null($userExist) &&
                ($userExist->getId() != $user->getId())
            ) {
                return $response->withStatus(401)->withJson(['error' =>"Usuário já cadastrado!"]);
            }
            $user->setEmail($data['email']);
        }

        if(isset($data['password'])){
            $user->setPassword($data['password']);
        }

        if(isset($data['name'])){
            $user->setName($data['name']);
        }

        $userDAO->update($user);


        $userResponse = [
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "name" => $user->getName(),
            "avatar" => $user->getAvatar(),
        ];

        $response = $response->withJson($userResponse);

        return $response;
    }
}
