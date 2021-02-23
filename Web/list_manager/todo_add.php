<?php require_once '../view/header.php'; ?>

<main>
<form action="list_manager/index.php" method="post">
    <input type="hidden" name="controllerRequest" value="todo_add_process">

    <input type="text" name="title" placeholder="Title"><br>        
    <input type="text" name="description" placeholder="Description"><br>

    <input type="submit" value="Add">
</form>
<!-- 
    TODO: use JS to validate before sending to the index to process 
    TODO: character length limits on names like above
-->
</main>

<?php require_once '../view/footer.php'; ?>
