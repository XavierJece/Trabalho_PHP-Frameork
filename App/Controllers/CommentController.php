<?php

namespace App\Controllers;

use App\DAO\MySQL\DoubtNo\CommentDAO;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\DoubtNo\PostDAO;
use App\DAO\MySQL\DoubtNo\UserDAO;
use App\Models\MySQL\DoubtNo\CommentModel;
use App\Models\MySQL\DoubtNo\PostModel;

final class CommentController
{
    public function create(Request $request, Response $response, array $args): Response
    {
        $userId = $request->getAttribute('userId');
        $data = $request->getParsedBody();

        $userDAO = new UserDAO();
        $user = $userDAO->getById($userId);

        if (is_null($user)) {
            return $response->withStatus(401);
        }

        $post = new PostModel('', $user);
        $postDAO = new PostDAO();
        $dataPost =$postDAO->getById($data['postId']);

        if (is_null($dataPost)) {
            return $response->withStatus(401);
        }

        $post->setId($dataPost['postId'])
            ->setDoubt($dataPost['doubt'])
            ->setDate($dataPost['datePost'])
            ->setUser($userDAO->getById($userId));

        $commentDAO = new CommentDAO();
        $commentDadId = isset($data['commentDadId']) ? $data['commentDadId'] : null;
        $comment = new CommentModel($data['content'], $user, $post, $commentDadId);
        $commentDAO->insert($comment);


        $commentResponse = [
            'id' => $comment->getId(),
            'content' => $comment->getContent(),
            'date' => $comment->getDate(),
            'user' => [
                'id' => $comment->getUser()->getId(),
                'email ' => $comment->getUser()->getEmail(),
                'name' => $comment->getUser()->getName(),
                'avatar' => $comment->getUser()->getAvatar(),
            ],
        ];

        $response = $response->withJson($commentResponse);

        return $response;
    }

    public function delete(Request $request, Response $response, array $args): Response
    {

        $userId = $request->getAttribute('userId');

        $userDAO = new UserDAO();
        $user = $userDAO->getById($userId);

        if (is_null($user)) {
            return $response->withStatus(401);
        }

        $commentId = $args['commentId'];

        $commentDAO = new CommentDAO();
        $commentDAO->delete($commentId);


        return $response;
    }
}
