<?php

class Comment {
    private $comment;
    private $timestamp;
    private $email;

    public function __construct($comment, $timestamp, $email)
    {
        $this->comment = $comment;
        $this->timestamp = $timestamp;
        $this->email = $email;
    }

    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @throws Exception
     */
    public function getTimestamp(): string
    {
        $date = new DateTime($this->timestamp);
        return $date->format('d/M/Y h:i:s');
    }

    public function getEmail()
    {
        return $this->email;
    }


}
