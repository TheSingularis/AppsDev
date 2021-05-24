<?php
require_once '../model/database.php';
class CalendarDB
{
    public static function getHistoryByTaskId($taskId)
    {
        global $db;
        $query = "SELECT dateComplete 
                  FROM history
                  WHERE taskID = '$taskId'";

        $statement = $db->prepare($query);

        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $dates = array();

        foreach ($rows as $row) {
            $date = $row['dateComplete'];

            $dates[] = $date;
        }

        return $dates;
    }
}
