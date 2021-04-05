<?php

namespace MVC\Controllers;

use MVC\Models\Task;
use MVC\Core\Controller;
use MVC\Models\TaskRepository;

class TasksController extends Controller
{

    function index()
    {
        $task = new TaskRepository();
        $d['tasks'] = $task->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            
            $taskModel= new Task();
            $taskModel->setTitle($_POST['title']);
            $taskModel->setDescription($_POST['description']);
            $taskModel->setCreate(date("Y-m-d H:i:s"));

            $taskRepos=new TaskRepository();
            if ($taskRepos->add($taskModel)){
                header("Location: " . WEBROOT . "Tasks/index");
            }

        }

        $this->render("create");

    }

    function edit($id)
    {

        $taskRepos= new TaskRepository();
        $d["task"] = $taskRepos->find($id);
        if (isset($_POST["title"]))
        {
            $taskModel=new Task();
            $taskModel->setId($id);
            $taskModel->setTitle($_POST['title']);
            $taskModel->setDescription($_POST['description']);
            $taskModel->setUpdate(date("Y-m-d H:i:s"));

            $taskRepos= new TaskRepository();

            if ($taskRepos->edit($taskModel)){

                header("Location: " . WEBROOT . "Tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");

    }

    function delete($id)
    {
        $task = new TaskRepository();
        if($task->delete($id)){
            header("Location: " . WEBROOT . "Tasks/index");
        }

    }
}

