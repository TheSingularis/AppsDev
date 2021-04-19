<?php require_once '../view/header.php'; ?>

<main>

    <table>
        <thead>
            <tr>
                <td><b>ID - Temp</b></td>
                <td><b>List ID - Temp</b></td>
                <td><b>Task Type ID - Temp</b></td>
                <td><b>Description</b></td>
                <td><b>Completed</b></td>
                <td><b>Repeat Time - Temp</b></td>
                <td><b>Product</b></td>
                <td><b>Product ID - Temp</b></td>
                <td><b>Product Volume - Temp</b></td>
                <td><b>Product Purchase Limit - Temp</b></td>
                <td><b>Created - Temp</b></td>
                <td><b>Updated - Temp</b></td>
                <td><b>Edit - Temp</b></td>
                <td><b>Delete - Temp</b></td>
            </tr>
        </thead>
        <tbody>
        <!-- 
            Use js so i can click on the row to edit or go into the list?? 
        -->
            <?php if (count($tasks) > 0) {
                foreach ($tasks as $task) : ?>
                    <?php $tableRow = ($newToDoId != null && $newToDoId == $task->getId()) ? '<tr id="new">' : '<tr>'; ?>
                        <td><?php echo $task->getId(); ?></td>
                        <td><?php echo $task->getListId(); ?></td>
                        <td><?php echo $task->getTaskTypeId(); ?></td>
                        <td><?php echo $task->getDescription(); ?></td>
                        <td><?php echo ($task->getCompleted() == 1) ? "True" : "False"; ?></td>
                        <td><?php echo $task->getRepeatTime(); ?></td>
                        <form action="list_manager/index.php" method="post">
                            <td>
                               <input type="hidden" name="controllerRequest" value="<?php echo ($task->getProductId() != null) ? "product_view" : "product_add"; ?>">
                               <input type="hidden" name="productId" value="<?php echo ($task->getProductId() != null) ? $task->getProductId() : -1; ?>">
                               <input type="hidden" name="currentTask" value="<?php echo $task->getId(); ?>">
                               <input type="submit" value="<?php echo ($task->getProductId() != null) ? "View" : "Add"; ?>">
                            </td>
                        </form>
                        <td><?php echo $task->getProductId(); ?></td>
                        <td><?php echo $task->getProductVolume(); ?></td>
                        <td><?php echo $task->getProductPurchaseLimit(); ?></td>
                        <td><?php echo $task->getUpdated(); ?></td>
                        <td><?php echo $task->getUpdated(); ?></td>
                        <form action="list_manager/index.php" method="post">
                            <td>
                                <input type="hidden" name="controllerRequest" value="task_edit">
                                <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                                <input type="submit" value="Edit">
                            </td>
                        </form>
                        <form action="list_manager/index.php" method="post">
                            <td>
                                <input type="hidden" name="controllerRequest" value="task_delete">
                                <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                                <input type="submit" value="Delete">
                            </td>
                        </form>
                    </tr>
                <?php endforeach; 
            }?>
            <tr>
                <td colspan="14">
                    <a href="list_manager?controllerRequest=task_add">
                        <!-- TODO: Center text -->
                        Add New Task List
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

</main>

<?php require_once '../view/footer.php'; ?>
