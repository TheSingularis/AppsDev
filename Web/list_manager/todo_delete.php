<?php require_once '../view/header.php'; ?>

<main>
    <h3>Confirm Deletion of List '<?php echo $todo->getTitle(); ?>'</h3>

    <a href="list_manager/index.php?controllerRequest=todo_list" class="btn btn-secondary">Cancel</a>

    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="todo_delete_process">
        <input type="hidden" name="todoId" value="<?php echo $todoId; ?>">
        <input type="submit" class="btn btn-danger" value="Delete">
    </form>

</main>

<?php require_once '../view/footer.php'; ?>
