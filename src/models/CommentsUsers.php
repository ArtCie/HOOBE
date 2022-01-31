<?php

class CommentsUsers
{
    private $email;
    private $comments;

    public function __construct(string $email, array $comments)
    {
        $this->email = $email;
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}