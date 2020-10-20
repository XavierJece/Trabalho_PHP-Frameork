<?php

namespace App\DAO\MySQL\DoubtNo;

use App\Models\MySQL\DoubtNo\UserModel;

class UserDAO extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getByEmail(string $email): ?UserModel
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    *
                FROM user
                WHERE email = :email;
            ');
        $statement->bindParam('email', $email);
        $statement->execute();
        $users= $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($users) === 0)
            return null;
        $user = new UserModel();
        $user->setId($users[0]['id'])
            ->setName($users[0]['name'])
            ->setEmail($users[0]['email'])
            ->setPassword($users[0]['password'])
            ->setAvatar($users[0]['avatar']);
        return $user;
    }

    public function getById(string $id): ?UserModel
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    *
                FROM user
                WHERE id = :id;
            ');
        $statement->bindParam('id', $id);
        $statement->execute();
        $users= $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($users) === 0)
            return null;
        $user = new UserModel();
        $user->setId($users[0]['id'])
            ->setName($users[0]['name'])
            ->setEmail($users[0]['email'])
            ->setPassword($users[0]['password'])
            ->setAvatar($users[0]['avatar']);
        return $user;
    }
}
