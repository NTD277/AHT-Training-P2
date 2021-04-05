<?php

namespace MVC\Models;

use MVC\Core\ResourceModel;
use MVC\Models\Task;

class TaskResourceModel extends ResourceModel
{
    public function __construct()
    {
        $task =new Task();
        $this->_init('tasks', null, $task );
    }
}

