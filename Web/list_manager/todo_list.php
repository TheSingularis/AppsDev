<?php require_once '../view/header.php'; ?>

<main>

    <table>
        <thead>
        <tr>
            <td><b>ID - Temp</b></td>
            <td><b>Title</b></td>
            <td><b>Description</b></td>
            <td><b>shareUUID - Temp</b></td>
            <td><b>Task Count</b></td>
            <td><b>Created - Temp</b></td>
            <td><b>Updated - Temp</b></td>
            <td><b>Edit - Temp</b></td>
            <td><b>View - Temp</b></td>
            <td><b>Delete - Temp</b></td>
        </tr>
        </thead>
        <tbody>
        <!-- 
            Use js so i can click on the row to edit or go into the list?? 
        -->
            <?php if (count($todos) > 0) {
                foreach ($todos as $todo) : ?>
                    <?php $tableRow = ($newToDoId != null && $newToDoId == $todo->getId()) ? '<tr id="new">' : '<tr>'; ?>
                        <td><?php echo $todo->getId(); ?></td>
                        <td><?php echo $todo->getTitle(); ?></td>
                        <td><?php echo $todo->getDescription(); ?></td>
                        <td><?php echo $todo->getShareUUID(); ?></td>
                        <td><?php echo $todo->getTaskCount(); ?></td>
                        <td><?php echo $todo->getCreated(); ?></td>
                        <td><?php echo $todo->getUpdated(); ?></td>
                        <form action="list_manager/index.php" method="post">
                            <td>
                                <input type="hidden" name="controllerRequest" value="todo_edit">
                                <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">
                                <input type="submit" value="Edit">
                            </td>
                        </form>
                        <form action="list_manager/index.php" method="post">
                            <td>
                                <input type="hidden" name="controllerRequest" value="task_list">
                                <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">
                                <input type="submit" value="View">
                            </td>
                        </form>
                        <form action="list_manager/index.php" method="post">
                            <td>
                                <input type="hidden" name="controllerRequest" value="todo_delete">
                                <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">
                                <input type="submit" value="Delete">
                            </td>
                        </form>
                    </tr>
                <?php endforeach; 
            }?>
            <tr>
                <td colspan="5">
                    <a href="list_manager?controllerRequest=todo_add">
                        <!-- TODO: Center text -->
                        Add New ToDo List
                    </a>
                </td>
                 <td colspan="4">
                    <a href="list_manager?controllerRequest=todo_share">
                        <!-- TODO: Center text -->
                        Add ToDo from Share Code
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

</main>

<?php require_once '../view/footer.php'; ?>
