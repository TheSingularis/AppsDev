<?php
require_once '../model/ToDo.php';
require_once '../model/TaskDB.php';
class ToDoDB
{
    public static function getAllToDos()
    {
        global $db;
        $query = "SELECT id, title, description, created, updated, shareUUID
                  FROM list";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $toDoLists = array();

        foreach ($rows as $row) {
            $todo = new ToDo($row['title'], $row['description'], $row['id'], $row['shareUUID'], count(TaskDB::getTasksByListId($row['id'])), $row['created'], $row['updated']);

            $toDoLists[] = $todo;
        }

        return $toDoLists;
    }

    public static function getAllToDosByUserId($userId)
    {
        global $db;
        $query = "SELECT list.id, list.title, list.description, list.created, list.updated, list.shareUUID
                  FROM list
                  JOIN userList ON list.id = userList.listID
                  WHERE userList.userID = '$userId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $toDoLists = array();

        foreach ($rows as $row) {
            $todo = new ToDo($row['title'], $row['description'], $row['id'], $row['shareUUID'], count(TaskDB::getTasksByListId($row['id'])), $row['created'], $row['updated']);

            $toDoLists[] = $todo;
        }

        return $toDoLists;
    }

    public static function getToDosByEmail($email)
    {
        global $db;
        $query = "SELECT l.id, l.title, l.description, l.created, l.updated, l.shareUUID
                      FROM list AS l
                      JOIN userList AS ul ON l.id = ul.listID
                      JOIN user AS u ON ul.userID = u.id
                      WHERE u.email = '$email'";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $toDoLists = array();

        foreach ($rows as $row) {
            $todo = new ToDo($row['title'], $row['description'], $row['id'], $row['shareUUID'], count(TaskDB::getTasksByListId($row['id'])), $row['created'], $row['updated']);

            $toDoLists[] = $todo;
        }

        return $toDoLists;
    }

    public static function getToDoById($todoId)
    {
        global $db;
        $query = "SELECT * 
                  FROM list
                  WHERE id = '$todoId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $todo = new ToDo($row['title'], $row['description'], $row['id'], $row['shareUUID'], count(TaskDB::getTasksByListId($row['id'])), $row['created'], $row['updated']);

        return $todo;
    }

    public static function getToDoByCode($shareId)
    {
        global $db;
        $query = "SELECT id 
                  FROM list
                  WHERE shareUUID = '$shareId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        return $row['id'];
    }

    public static function insertNewList($todo)
    {
        global $db;

        $query = "INSERT INTO list (title, description, shareUUID)
                  VALUES (:title, :description, left(uuid(),8))";

        $statement = $db->prepare($query);

        $statement->bindValue(':title', $todo->getTitle());
        $statement->bindValue(':description', $todo->getDescription());

        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function updateToDo($todoId, $title, $description)
    {
        global $db;

        $query = "UPDATE list
                  SET title = :title, description = :description, updated = NOW()
                  WHERE id = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':id', $todoId);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
    }

    public static function insertNewUserList($userId, $todoId)
    {
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

    public static function deleteList($todoId)
    {
        global $db;

        ToDoDB::deleteUserList($todoId);
        ToDoDB::deleteTasks($todoId);

        $query = "DELETE FROM list WHERE id = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':id', $todoId);

        $statement->execute();
        $statement->closeCursor();
    }

    public static function deleteUserList($todoId)
    {
        global $db;

        $query = "DELETE FROM userList WHERE listID = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':id', $todoId);

        $statement->execute();
        $statement->closeCursor();
    }

    public static function deleteTasks($todoId)
    {
        global $db;

        $query = "DELETE FROM task WHERE listID = :id";

        $statement = $db->prepare($query);

        $statement->bindValue(':id', $todoId);

        $statement->execute();
        $statement->closeCursor();
    }
}
