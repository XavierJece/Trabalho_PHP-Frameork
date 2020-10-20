<?php

namespace App\Models\MySQL\DoubtNo;

final class PostModel
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $doubt;
    /**
     * @var UserModel
     */
    private $user;
    /**
     * @var date
     */
    private $date;

    // Constructor
    /**
     * @param string $doubt
     * @param UserModel $user
     */
    function __construct(string $doubt, UserModel $user)
    {
        $this->id = uniqid();
        $this->doubt = $doubt;
        $this->user = $user;
        $this->date = date("Y-m-d H:i:s");
    }

    // Gets and Sets
    public function getId()
    {
        return $this->id;
    }

    public function getDoubt()
    {
        return $this->doubt;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDate()
    {
        return $this->date;
    }
}
