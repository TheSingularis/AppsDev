<?php require_once '../view/header.php'; ?>

<main>

    <table>
        <!--
        <thead>
        <tr>
            <td><b>Title</b></td>
            <td><b>Description</b></td>
            <td><b>Task Count</b></td>
            <td><b>Edit - Temp</b></td>
            <td><b>View - Temp</b></td>
            <td><b>Delete - Temp</b></td>
        </tr>
        </thead>
        -->

        <!-- Bootstrap Collapse
        <tbody>
        <?php if (count($todos) > 0) {
            foreach ($todos as $todo) : ?>
                <tr>
                    <td><?php echo $todo->getTitle(); ?></td>
                </tr>
            <?php endforeach;
        }?>
        </tbody>
        -->

        
        <tbody>
            <?php if (count($todos) > 0) {
                foreach ($todos as $todo) : ?>
                    <tr>
                        <td><?php echo $todo->getTitle(); ?></td>
                        <td><?php echo $todo->getDescription(); ?></td>
                        <td><?php echo $todo->getTaskCount(); ?></td>
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
                <td colspan="3">
                    <a href="list_manager?controllerRequest=todo_add">
                        Add New ToDo List
                    </a>
                </td>
                 <td colspan="3">
                    <a href="list_manager?controllerRequest=todo_share">
                        Add ToDo from Share Code
                    </a>
                </td>
            </tr>
        </tbody>
        
    </table>

</main>

<?php require_once '../view/footer.php'; ?>
