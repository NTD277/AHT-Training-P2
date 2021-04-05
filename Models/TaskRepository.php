<?php

namespace MVC\Models;

use MVC\Models\TaskResourceModel;

class TaskRepository
{
    public function add($model)
    {
        $task = new TaskResourceModel();
        return $task->save($model);
    }

    public function delete($id)
    {
        $task=new TaskResourceModel();
        return $task->delete($id);
    }

    public function getAll()
    {
        $task=new TaskResourceModel();
        return $task->getAll();
    }

    public function edit($model){
        $task=new TaskResourceModel();
        return $task->save($model);
    }

    public function find($id)
    {
        $task= new TaskResourceModel();
        return $task->find($id);
    }
    
}

