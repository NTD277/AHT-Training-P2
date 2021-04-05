<?php

namespace MVC\Models;

use MVC\Core\Model;

class Task extends Model
{

    protected $title;
    protected $description;
    protected $id;
    protected $updated_at;
    protected $created_at;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
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
    
    public function getCreate()
    {
        return $this->created_at;
    }
    public function setCreate($created_at)
    {
        $this->created_at=$created_at;
    }

    public function getUpdate()
    {
        return $this->updated_at;
    }
    public function setUpdate($updated_at)
    {
        $this->updated_at = $updated_at;
    }

}

