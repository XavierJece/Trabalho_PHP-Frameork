<?php

namespace App\Models\MySQL\DoubtNo;

final class CommentModel
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $content;
    /**
     * @var UserModel
     */
    private $user;
    /**
     * @var PostModel
     */
    private $post;
    /**
     * @var string
     */
    private $dadId;
    /**
     * @var date
     */
    private $date;

    // Constructor
    /**
     * @param string $content
     * @param UserModel $user
     * @param PostModel $post
     * @param string $commentDad
     */
    function __construct(string $content, UserModel $user, PostModel $post, string $commentDad = null)
    {
        $this->id = uniqid();
        $this->content = $content;
        $this->user = $user;
        $this->post = $post;

        if(!is_null($commentDad)){
            $this->commentDad = $commentDad;
        }

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content  = $content;
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
     * @param UserModel $user
     * @return self
     */
    public function setUser(string $user)
    {
        $this->user  = $user;
        return $this;
    }


    /**
     * @return PostModel
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param PostModel $post
     * @return self
     */
    public function setPost(string $post)
    {
        $this->post  = $post;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommentDad()
    {
        return $this->commentDad;
    }

    /**
     * @param string $dadId
     * @return self
     */
    public function setDad(string $dadId)
    {
        $this->dadId = $dadId;
        return $this;
    }


    /**
     * @return Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param Date $date
     * @return self
     */
    public function setDate(string $date)
    {
        $this->date = $date;
        return $this;
    }
}
