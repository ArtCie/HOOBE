<?php

class Article {
    private $index;
    private $header;
    private $content;
    private $jpgPath;
    private $likes;
    private $comments;
    private $insertTimestamp;


    public function __construct($header, $content, $insertTimestamp, $index, $path=null, $likes=null, $comments=null)
    {
        $this->index = $index;
        $this->header = $header;
        $this->content = $content;
        $this->jpgPath = $path;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->insertTimestamp = $insertTimestamp;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getJpgPath()
    {
        return $this->jpgPath;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getInsertTimestamp()
    {
        return $this->insertTimestamp;
    }

    public function updateContent()
    {
        $this->content = substr($this->content, 0, 100) . "...";
    }
}
