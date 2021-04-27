<?php require_once '../view/header.php'; ?>

<main>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="todo_edit_process">
        <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">

        <input type="text" name="title" placeholder="Title" value="<?php echo $todo->getTitle(); ?>"><br>
        <input type="text" name="description" placeholder="Description" value="<?php echo $todo->getDescription(); ?>"><br>

        <input type="submit" class="btn btn-primary" value="Save">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
