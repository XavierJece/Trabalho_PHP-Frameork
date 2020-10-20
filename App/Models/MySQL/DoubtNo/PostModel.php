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
     * @var string
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

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id)
    {
        $this->id  = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDoubt()
    {
        return $this->doubt;
    }

    /**
     * @param string $doubt
     * @return self
     */
    public function setDoubt(string $doubt)
    {
        $this->doubt = $doubt;
        return $this;
    }

    /**
     * @return UserModel
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserModel $doubt
     * @return self
     */
    public function setUser(UserModel $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return self
     */
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }


}
