<?php require_once '../view/header.php'; ?>

<main>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="task_edit_process">
        <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">

        <input type="text" name="taskTypeId" placeholder="TaskType" value="<?php echo $task->getTaskTypeId(); ?>"><br>
        <input type="text" name="description" placeholder="Description" value="<?php echo $task->getDescription(); ?>"><br>
        <input type="text" name="completed" placeholder="Completed" value="<?php echo $task->getCompleted(); ?>"><br>

        <input type="submit" value="Save">
    </form>    
</main>

<?php require_once '../view/footer.php'; ?>
