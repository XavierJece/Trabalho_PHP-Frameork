<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\PostDAO;
use App\DAO\MySQL\DoubtNo\UserDAO;
use App\DAO\MySQL\DoubtNo\CommentDAO;
use App\Models\MySQL\DoubtNo\PostModel;
use App\Models\MySQL\DoubtNo\UserModel;

final class PostController
{
    public function index(Request $request, Response $response, array $args): Response
    {
        try{
            $postDAO = new PostDAO();
            $posts = $postDAO->getAll();

            $postResponse = array();
            foreach ($posts as $value){
                $post = [
                    'id' => $value['postId'],
                    'doubt' => $value['doubt'],
                    'date' => $value['datePost'],
                    'user' => [
                        'id' => $value['userId'],
                        'email ' => $value['email'],
                        'name' => $value['name'],
                        'avatar' => $value['avatar'],
                    ]
                ];

                array_push($postResponse, $post);

            }

            $response = $response->withJson($postResponse);

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
            return $response->withStatus(401)->withJson(['error' => 'Usuário não existe!']);
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
        $postId = $args['postId'];

        $postDAO = new PostDAO();
        $commentDAO = new CommentDAO();
        $dataPost = $postDAO->getById($postId);
        $dataCommentsDads = $commentDAO->getByPost($postId);

        $commentsDadResponse = array();
        if(!is_null($dataCommentsDads)){
            foreach ($dataCommentsDads as $value){
                $dataCommentsChildren = $commentDAO->getChildren($value['commentId']);

                $commentsChildrenResponse = array();
                if(!is_null($dataCommentsDads)){
                    foreach ($dataCommentsChildren as $value){
                        $commentsChildren = [
                            'id' => $value['commentId'],
                            'content' => $value['content'],
                            'date' => $value['commentDate'],
                            'user' => [
                                'id' => $value['userId'],
                                'name' => $value['name'],
                                'email' => $value['email'],
                                'avatar' => $value['avatar']
                            ]
                        ];
                        array_push($commentsChildrenResponse, $commentsChildren);
                    }
                }


                $commentDad = [
                    'id' => $value['commentId'],
                    'content' => $value['content'],
                    'date' => $value['commentDate'],
                    'user' => [
                        'id' => $value['userId'],
                        'name' => $value['name'],
                        'email' => $value['email'],
                        'avatar' => $value['avatar']
                    ],
                    'commentsChildren' => $commentsChildrenResponse
                ];

                array_push($commentsDadResponse, $commentDad);

            }
        }

        $postResponse = [
            'id' => $dataPost['postId'],
            'doubt' => $dataPost['doubt'],
            'date' => $dataPost['datePost'],
            'user' => [
                'id' => $dataPost['userId'],
                'email ' => $dataPost['email'],
                'name' => $dataPost['name'],
                'avatar' => $dataPost['avatar'],
            ],
            'comments' => $commentsDadResponse
        ];

        $response = $response->withJson($postResponse);

        return $response;
    }
}
