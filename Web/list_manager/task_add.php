<?php require_once '../view/header.php'; ?>

<main>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="task_add_process">

        <input type="hidden" name="taskTypeId" value="1"><br>
        <input type="text" name="description" placeholder="Description"><br>
        <input type="hidden" name="completed" value="0"><br>

        <input type="submit" value="Add">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
