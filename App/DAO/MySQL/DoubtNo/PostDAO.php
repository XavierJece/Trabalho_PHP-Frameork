<?php

namespace App\DAO\MySQL\DoubtNo;

use App\Models\MySQL\DoubtNo\{
    PostModel,
    UserModel
};

class PostDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(): array
    {
        $statement = $this->pdo
            ->prepare('SELECT P.id As "postId", P.doubt, P.date_post AS "datePost", P.user AS "userId", U.name, U.avatar, U.email FROM post AS P JOIN user AS U ON (P.user = U.id) ORDER BY  P.date_post DESC;');
        $statement->execute();
        $posts = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getById(string $id): ?array
    {
        $statement = $this->pdo
            ->prepare('SELECT P.id As "postId", P.doubt, P.date_post AS "datePost", P.user AS "userId", U.name, U.avatar, U.email FROM post AS P JOIN user AS U ON (P.user = U.id) WHERE P.id = :id');
        $statement->bindParam('id', $id);
        $statement->execute();
        $posts= $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($posts) === 0)
            return null;

        return $posts[0];
    }


    public function insert(PostModel $post): PostModel
    {
        $statement = $this->pdo
            ->prepare(
                'INSERT INTO
                    `post`(`id`, `doubt`, `user`, `date_post`)
                VALUES
                    ( :id, :doubt, :user, :date_post)');
        $statement->bindValue(":id", $post->getId());
        $statement->bindValue(":doubt", $post->getDoubt());
        $statement->bindValue(":user", $post->getUser()->getId());
        $statement->bindValue(":date_post", $post->getDate());
        $statement->execute();

        return $post;
    }
}
