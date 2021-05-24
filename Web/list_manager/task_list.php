<?php require_once '../view/header.php'; ?>

<main>
    <a class="btn btn-primary" href="list_manager?controllerRequest=task_add" role="button">Add new Task</a>
    <br>
    <br>
    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
        <div class="card">
            <?php if (count($tasks) > 0) {
                foreach ($tasks as $task) : ?>
                    <div class="card-header" role="tab" id="heading<?php echo $task->getId(); ?>">
                        <?php if ($task->getProductId() == null) : ?>
                            <span><?php echo $task->getDescription(); ?></span>
                            <span>
                                <!-- Empty for spacing -->
                            </span>
                        <?php else : ?>
                            <span><?php echo $task->getDescription(); ?></span>
                            <span>
                                <?php
                                foreach ($products as $product) {
                                    if ($product->getId() == $task->getProductId()) {
                                        echo $product->getProductName();
                                    }
                                }
                                ?>
                            </span>
                        <?php endif; ?>

                        <span>
                            <!-- Spacing -->
                        </span>

                        <!-- check button -->
                        <span>
                            <form action="list_manager/index.php" method="post">
                                <input type="hidden" name="controllerRequest" value="task_complete_toggle">
                                <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">

                                <input type="image" name="submit" src="addons/bootstrap-icons/<?php echo ($task->getCompleted() == 1) ? 'check-square' : 'x-square'; ?>.svg" width="35" color="blue">
                            </form>
                        </span>

                        <!-- collapse button for edit -->
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapse<?php echo $task->getId(); ?>" aria-expanded="false" aria-controls="collapse<?php echo $task->getId(); ?>" style="color:inherit;">
                            <h1 class="mb-0">
                                <i class="bi-caret-down rotate-icon" width="35"></i>
                            </h1>
                        </a>
                    </div>
                    <div id="collapse<?php echo $task->getId(); ?>" class="collapse" role="tabpanel" aria-labledby="heading<?php echo $task->getId(); ?>" data-parent="#accordionEx">
                        <div class="card-body">
                            <span>
                                <form action="list_manager/index.php" method="post">
                                    <input type="hidden" name="controllerRequest" value="task_edit">
                                    <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                                    <input type="submit" class="btn btn-secondary" value="Edit">
                                </form>
                            </span>
                            <span>
                                <form action="list_manager/index.php" method="post">
                                    <input type="hidden" name="controllerRequest" value="<?php echo ($task->getProductId() != null) ? "product_view" : "product_add"; ?>">
                                    <input type="hidden" name="productId" value="<?php echo ($task->getProductId() != null) ? $task->getProductId() : -1; ?>">
                                    <input type="hidden" name="currentTask" value="<?php echo $task->getId(); ?>">
                                    <input type="submit" class="btn btn-secondary" value="<?php echo ($task->getProductId() != null) ? "View" : "Add"; ?> Product">
                                </form>
                            </span>
                            <span>
                                <!-- Spacing -->
                            </span>
                            <span>
                                <form action="list_manager/index.php" method="post">
                                    <input type="hidden" name="controllerRequest" value="task_history">
                                    <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                                    <input type="submit" class="btn btn-secondary" value="View History">
                                </form>
                            </span>
                            <span>
                                <form action="list_manager/index.php" method="post">
                                    <input type="hidden" name="controllerRequest" value="task_delete">
                                    <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </span>
                        </div>
                    </div>
            <?php endforeach;
            } ?>
        </div>
    </div>

    <!-- 
        <tbody>
            <?php if (count($tasks) > 0) {
                foreach ($tasks as $task) : ?>
                    <tr>
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
            } ?>
            <tr>
                <td colspan="14">    

                    <a href="list_manager?controllerRequest=task_add">
                        Add New Task List
                    </a>
                </td>
            </tr>
        </tbody>
            -->

</main>

<?php require_once '../view/footer.php'; ?>
