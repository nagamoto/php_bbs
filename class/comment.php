<?php

class Comment {
    private $user_id;
    private $thread_id;
    private $text;

    public function __construct($user_id, $thread_id, $text){
        $this->user_id = $user_id;
        $this->thread_id = $thread_id;
        $this->text = $text;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getThreadId()
    {
        return $this->thread_id;
    }

    public function setThreadId($thread_id)
    {
        $this->thread_id = $thread_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
}