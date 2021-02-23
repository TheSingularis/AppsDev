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
            $task = new Task($row['taskTypeID'], $row['description'], $row['completed'], $row['id'], $row['listID'], $row['repeatTime'], $row['productID'], $row['productVolume'], $row['productPurchaseLimit'], $row['created'], $row['updated']);
            
            $tasks[] = $task;    
        }

        return $tasks;
    }
}
