<?php

if (session_id() == '') {
    $lifetime = 60 * 60 * 24 * 7 * 2;
    //2 weeks in seconds

    session_set_cookie_params($lifetime, '/');
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: ../user_manager/index.php?controllerRequest=user_login');
}

$controllerChoice = filter_input(INPUT_POST, 'controllerRequest');

if ($controllerChoice == null) {
    $controllerChoice = filter_input(INPUT_GET, 'controllerRequest');

    if ($controllerChoice == null) {
        $controllerChoice = 'todo_list';
    }
}

require_once '../model/database.php';
require_once '../model/User.php';
require_once '../model/UserDB.php';
require_once '../model/ToDo.php';
require_once '../model/ToDoDB.php';

$user = unserialize($_SESSION['user']);     //after requiring the user class

switch ($controllerChoice) {                //naming convention is "'location'_'action'" i.e. todo_list or task_list
    case 'todo_list':
        $todos = ToDoDB::getAllToDosByUserId($user->getId()); 

        $newToDoId = -1;
        if (isset($_SESSION['newToDoId'])) {
            $newToDoId = $_SESSION['newToDoId'];
            $_SESSION['newToDoId'] = -1;
        }

        include 'todo_list.php';
        break;
    case 'todo_add':
        include 'todo_add.php';
        break;
    case 'todo_add_process':
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');

        $todo = new ToDo($title, $description);
        
        $newToDoId = ToDoDB::insertNewList($todo);   
        $newUserListId = ToDoDB::insertNewUserList($user->getId(), $newToDoId); 

        if ($newToDoId != null) {
            $_SESSION['newToDoId'] = $newToDoId;
            
            header('Location: ../list_manager/index.php');
        }

        break;
    case 'todo_edit':
        $todoId = filter_input(INPUT_POST, 'todoId');
        $todo = ToDoDB::getToDoById($todoId);

        include 'todo_edit.php';
        break;
    case 'todo_edit_process':
        $todoId = filter_input(INPUT_POST, 'todoId');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        
        $newToDoId = ToDoDB::updateToDo($todoId, $title, $description);
        
        if ($newToDoId !== null) {
            $_SESSION['newToDoId'] = $newToDoId;
            
            header('Location: ../list_manager/index.php');
        }
        break;
    case 'todo_share':
        include 'todo_share.php';
        break;
    case 'todo_share_process':

        $shareId = filter_input(INPUT_POST, 'shareId');
        $todoId = ToDoDB::getToDoByCode($shareId);

        $newUserListId = ToDoDB::insertNewUserList($user->getId(), $todoId);

        if ($todoId == null || $newUserListId == null) {
            $badCode = true;
            include 'todo_share.php';
        } else {
            header('Location: ../list_manager/index.php');
        }

        break;
    case 'task_list':
        
        if (isset($_POST['todoId'])) {
            $todoId = filter_input(INPUT_POST, 'todoId');
            $_SESSION['todoId'] = $todoId;
        } else {    
            $todoId = $_SESSION['todoId'];
        }

        $tasks = TaskDB::getTasksByListId($todoId);

        if (isset($_SESSION['newTaskId']) && $_SESSION['newTaskId'] > 0) {
            $newTaskId = $_SESSION['newTaskId'];
            $_SESSION['newTaskId'] = -1;
        }

        include 'task_list.php';
        break;
    case 'task_add':
        include 'task_add.php';
        break;
    case 'task_add_process':
        $taskTypeId = filter_input(INPUT_POST, 'taskTypeId');
        $description = filter_input(INPUT_POST, 'description');
        $completed = filter_input(INPUT_POST, 'completed');

        $task = new Task($taskTypeId, $description, $completed, $_SESSION['todoId']);

        $newTaskId = TaskDB::insertNewTask($task);

        if ($newTaskId != null) {
            $_SESSION['newTaskId'] = $newTaskId;

            header('Location: ../list_manager/index.php?controllerRequest=task_list');
        }
        break;
    case 'task_edit':
        $taskId = filter_input(INPUT_POST, 'taskId');
        $task = TaskDB::getTaskById($taskId);

        include 'task_edit.php';
        break;
    case 'task_edit_process':
        $taskId = filter_input(INPUT_POST, 'taskId');
        $taskTypeId = filter_input(INPUT_POST, 'taskTypeId');
        $description = filter_input(INPUT_POST, 'description');
        $completed = filter_input(INPUT_POST, 'completed');

        $newTaskId = TaskDB::updateTask($taskId, $taskTypeId, $description, $completed);

        if ($newTaskId != null) {
            $_SESSION['newTaskId'] = $newTaskId;

            header('Location: ../list_manager/index.php?controllerRequest=task_list');
        }
        break;
    case 'todo_delete':
        $todoId = filter_input(INPUT_POST, 'todoId');

        ToDoDB::deleteList($todoId);

        header('Location: ../list_manager/index.php?controllerRequest=todo_list');
        break;
    case 'task_delete':
        $taskId = filter_input(INPUT_POST, 'taskId');

        TaskDB::deleteTask($taskId);
        
        header('Location: ../list_manager/index.php?controllerRequest=task_list');
        break;
}
