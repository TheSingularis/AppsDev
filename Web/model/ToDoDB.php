<?php
require_once '../model/ToDo.php';
require_once '../model/TaskDB.php';
class ToDoDB
{
    public static function getAllToDosByUserId($userId) {
        global $db;
        $query = "SELECT list.id, list.title, list.description, list.created, list.updated
                  FROM list
                  JOIN userList ON list.id = userList.listID
                  WHERE userList.userID = '$userId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $toDoLists = array();
        
        foreach ($rows as $row) {
            $todo = new ToDo($row['title'], $row['description'], $row['id'], count(TaskDB::getTasksByListId($row['id'])), $row['created'], $row['updated']);
            
            $toDoLists[] = $todo;
        }

        return $toDoLists;
    }

    public static function getToDoById($todoId) {
        global $db;
        $query = "SELECT * 
                  FROM list
                  WHERE id = '$todoId'";
        
        $statement = $db->prepare($query);

        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $todo = new ToDo($row['title'], $row['description'], $row['id'], count(TaskDB::getTasksByListId($row['id'])), $row['created'], $row['updated']);

        return $todo;
    }


    public static function insertNewList($todo) {
        global $db;

        $query = "INSERT INTO list (title, description)
                  VALUES (:title, :description)";
        
        $statement = $db->prepare($query);

        $statement->bindValue(':title', $todo->getTitle());
        $statement->bindValue(':description', $todo->getDescription());

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function updateToDo($todoId, $title, $description) {
        global $db;

        $query = "UPDATE list
                  SET title = :title, description = :description, updated = NOW()
                  WHERE id = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $todoId);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();          

        return $db->lastInsertId();
    }

    public static function insertNewUserList($userId, $todoId) {
        global $db;

        $query = "INSERT INTO userList (listID, userID)
                  VALUES (:listID, :userID)";

        $statement = $db->prepare($query);

        $statement->bindValue(':listID', $todoId);
        $statement->bindValue(':userID', $userId);

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }
}
