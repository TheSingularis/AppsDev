<?php require_once '../view/header.php'; ?>

<main>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="task_add_process">

        <input type="text" name="taskTypeId" placeholder="TaskType"><br>
        <input type="text" name="description" placeholder="Description"><br>
        <input type="text" name="completed" placeholder="Completed"><br>

        <input type="submit" value="Add">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
