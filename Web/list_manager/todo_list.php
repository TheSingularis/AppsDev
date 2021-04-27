<?php require_once '../view/header.php'; ?>

<main>

    <a class="btn btn-primary" href="list_manager?controllerRequest=todo_add" role="button">Add new List</a>
    <a class="btn btn-primary" href="list_manager?controllerRequest=todo_share" role="button">Add List from code</a>
    <br>
    <br>
    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
        <div class="card">
            <?php if (count($todos) > 0) {
                foreach ($todos as $todo) : ?>
                    <div class="card-header" role="tab" id="heading<?php echo $todo->getId(); ?>">
                        <span><?php echo $todo->getTitle(); ?></span>
                        <span><?php echo $todo->getDescription(); ?></span>
                        <span>
                            <?php
                            echo $todo->getTaskCount();
                            if ($todo->getTaskCount() != 1) {
                                echo ' items';
                            } else {
                                echo ' item';
                            }
                            ?>
                        </span>
                        <span>
                            <form action="list_manager/index.php" method="post">
                                <input type="hidden" name="controllerRequest" value="task_list">
                                <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">
                                <input type="submit" class="btn btn-secondary" value="View">
                            </form>
                        </span>
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapse<?php echo $todo->getId(); ?>" aria-expanded="false" aria-controls="collapse<?php echo $todo->getId(); ?>" style="color:inherit;">
                            <h1 class="mb-0">
                                <i class="bi-caret-down rotate-icon" width="35"></i>
                            </h1>
                        </a>
                    </div>
                    <div id="collapse<?php echo $todo->getId(); ?>" class="collapse" role="tabpanel" aria-labledby="heading<?php echo $todo->getId(); ?>" data-parent="#accordionEx">
                        <div class="card-body">
                            <span>
                                <form action="list_manager/index.php" method="post">
                                    <input type="hidden" name="controllerRequest" value="todo_edit">
                                    <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">
                                    <input type="submit" class="btn btn-secondary" value="Edit">
                                </form>
                            </span>
                            <span>
                                <b>Sharing Code: </b>
                                <?php
                                echo $todo->getShareUUID();
                                ?>
                            </span>
                            <span>
                                <!-- Spacing -->
                            </span>
                            <span>
                                <form action="list_manager/index.php" method="post">
                                    <input type="hidden" name="controllerRequest" value="todo_delete">
                                    <input type="hidden" name="todoId" value="<?php echo $todo->getId(); ?>">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </span>
                        </div>
                    </div>
            <? endforeach;
            } ?>
        </div>
    </div>

    <!--
    <table>
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

        <tbody>
        <?php if (count($todos) > 0) {
            foreach ($todos as $todo) : ?>
                <tr>
                    <td><?php echo $todo->getTitle(); ?></td>
                </tr>
            <?php endforeach;
        } ?>
        </tbody>

        
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
            } ?>
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
    -->
</main>

<?php require_once '../view/footer.php'; ?>
