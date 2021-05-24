<?php require_once '../view/header.php'; ?>

<main>
    <?php
    if ($badCode) {
        echo '<h4 style="color:red;">The code you entered was not recognised</h4>';
    }
    ?>

    <form action="list_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="todo_share_process">

        <input type="text" name="shareId" placeholder="Share Code" class="form-control">

        <input type="submit" class="btn btn-primary" value="Add">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
