<?php

namespace App\DAO\MySQL\DoubtNo;

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
        $post = $statement->fetchAll(\PDO::FETCH_ASSOC);

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
