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
            ->prepare('SELECT
                    *
                FROM post;');
        $statement->execute();
        $posts = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $posts;
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

    // public function getAllProdutosFromLoja(int $lojaId): array
    // {
    //     $statement = $this->pdo
    //         ->prepare('SELECT
    //                 *
    //             FROM produtos
    //             WHERE
    //                 loja_id = :loja_id
    //         ;');
    //     $statement->bindParam(':loja_id', $lojaId, \PDO::PARAM_INT);
    //     $statement->execute();
    //     $produtos = $statement->fetchAll(\PDO::FETCH_ASSOC);

    //     return $produtos;
    // }
}
