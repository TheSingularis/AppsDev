<?php require_once '../view/header.php'; ?>

<main>
    <h3>Confirm Deletion of Task '<?php echo $task->getDescription(); ?>'</h3>

    <a href="list_manager/index.php?controllerRequest=task_list" class="btn btn-secondary">Cancel</a>

    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="task_delete_process">
        <input type="hidden" name="taskId" value="<?php echo $taskId; ?>">
        <input type="submit" class="btn btn-danger" value="Delete">
    </form>

</main>

<?php require_once '../view/footer.php'; ?>
