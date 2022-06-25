<?php

class Movie {
    private $title;
    private $description;
    private $img;
    private $like;
    private $dislike;
    private $id;

    public function __construct($title, $description, $img, $like = 0, $dislike = 0, $id = null){
        $this->title = $title;
        $this->description = $description;
        $this->img = $img;
        $this->like = $like;
        $this->dislike = $dislike;
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function getLike()
    {
        return $this->like;
    }

    public function setLike($like)
    {
        $this->like = $like;
    }

    public function getDislike()
    {
        return $this->dislike;
    }

    public function setDislike($dislike)
    {
        $this->dislike = $dislike;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


}