<?php require_once '../view/header.php'; ?>

<main>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="task_edit_process">
        <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">

        <input type="hidden" name="taskTypeId" value="1"><br>
        <input type="text" name="description" placeholder="Description" value="<?php echo $task->getDescription(); ?>" class="form-control">
        <input type="hidden" name="completed" value="<?php echo $task->getCompleted(); ?>">

        <input type="submit" class="btn btn-primary" value="Save">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
