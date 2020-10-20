<?php

namespace App\DAO\MySQL\DoubtNo;

use App\Models\MySQL\DoubtNo\{
    CommentModel,
    PostModel
};

class CommentDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getByPost(string $postId): ?array
    {
        $statement = $this->pdo
            ->prepare('SELECT C.id AS "commentId", C.content, C.date_comment AS "commentDate", C.user AS "userId", U.name, U.avatar, U.email FROM comment AS C JOIN user AS U ON (C.user = U.id) WHERE `post` = :postId AND `commentDad` IS NULL ORDER BY  `date_comment` DESC');
        $statement->bindParam(':postId', $postId);
        $statement->execute();
        $comments= $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($comments) === 0)
            return null;

        return $comments;
    }

    public function getChildren(string $commentDadId): ?array
    {
        $statement = $this->pdo
            ->prepare('SELECT C.id AS "commentId", C.content, C.date_comment AS "commentDate", C.user AS "userId", U.name, U.avatar, U.email FROM comment AS C JOIN user AS U ON (C.user = U.id) WHERE `commentDad` = :commentDadId ORDER BY  `date_comment` DESC');
        $statement->bindParam(':commentDadId', $commentDadId);
        $statement->execute();
        $comments= $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($comments) === 0)
            return null;

        return $comments;
    }

    public function insert(CommentModel $comment): CommentModel
    {
        $statement = $this->pdo
            ->prepare(
                'INSERT INTO
                    `comment`(`id`, `content`, `user`, `post`, `commentDad`, `date_comment`)
                VALUES
                    (:id, :content, :user, :post, :commentDad, :date_comment)');
         $statement->bindValue(":commentDad", $comment->getCommentDad());
         $statement->bindValue(":id", $comment->getId());
         $statement->bindValue(":content", $comment->getContent());
         $statement->bindValue(":user", $comment->getUser()->getId());
         $statement->bindValue(":post", $comment->getPost()->getId());
         $statement->bindValue(":date_comment", $comment->getDate());
        $statement->execute();

        return $comment;
    }

    public function delete(string $id){
        $stmt = $this->pdo->prepare("DELETE FROM `comment` WHERE `id` = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }
}
