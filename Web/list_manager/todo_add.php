<?php require_once '../view/header.php'; ?>

<main>
    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="todo_add_process">

        <input type="text" name="title" placeholder="Title"><br>
        <input type="text" name="description" placeholder="Description"><br>

        <input type="submit" class="btn btn-primary" value="Add">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
