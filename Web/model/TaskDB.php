<?php
require_once '../model/Task.php';

class TaskDB
{
    public static function getTasksByListId($listId) { 
        global $db;
        $query = "SELECT * 
                  FROM task
                  WHERE listID = '$listId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $tasks = array();

        foreach ($rows as $row) {
            $task = new Task($row['taskTypeID'], $row['description'], $row['completed'], $row['listID'], $row['id'], $row['repeatTime'], $row['productID'], $row['productVolume'], $row['productPurchaseLimit'], $row['created'], $row['updated']);
            
            $tasks[] = $task;    
        }

        return $tasks;
    }

    public static function getTaskById($taskId) {
        global $db;
        $query = "SELECT *
                  FROM task
                  WHERE id = '$taskId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $task = new Task($row['taskTypeId'], $row['description'], $row['completed'], $row['listID'], $row['id'], $row['repeatTime'], $row['productID'], $row['productVolume'], $row['productPurchaseLimit'], $row['created'], $row['updated']);

        return $task;
    }

    public static function insertNewTask($task) {
        global $db;

        $query = "INSERT INTO task (taskTypeID, description, completed, listID)
                  VALUES (:taskTypeID, :description, :completed, :listID)";

        $statement = $db->prepare($query);

        $statement->bindvalue(':taskTypeID', $task->getTaskTypeId());
        $statement->bindvalue(':description', $task->getDescription());
        $statement->bindvalue(':completed', $task->getCompleted());
        $statement->bindvalue(':listID', $task->getListId());

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function updateTask ($taskId, $taskTypeId, $description, $completed) {
        global $db;

        $query = "UPDATE task
                  SET taskTypeID = :taskTypeID, description = :description, completed = :completed, updated = NOW()
                  WHERE id = :id";
        
        $statement = $db->prepare($query);

        $statement->bindValue(':id', $taskId);
        $statement->bindValue(':taskTypeID', $taskTypeId);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':completed', $completed);

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function updateTaskProduct($task, $productId) {
        global $db;

        $query = "UPDATE task
                  SET productID = :productID, updated = NOW()
                  WHERE id = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':productID', $productId);
        $statement->bindValue(':id', $task->getId());

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function deleteTask ($taskId) {
        global $db;

        $query = "DELETE FROM task WHERE id = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':id', $taskId);

        $statement->execute();
        $statement->closeCursor();
    }

    public static function setTaskCompleted ($taskId, $completed) {
        global $db;

        $query = "UPDATE task
                  SET completed = :completed, updated = NOW()
                  WHERE id = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':completed', $completed);
        $statement->bindValue(':id', $taskId);

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }
}
