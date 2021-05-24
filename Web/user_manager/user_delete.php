<?php require_once '../view/header.php'; ?>

<main>
    <h3>Confirm Deletion of User Account '<?php echo $user->getFullName(); ?>'</h3>

    <a href="user_manager/index.php?controllerRequest=user_profile" class="btn btn-secondary">Cancel</a>

    <form action="user_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="user_delete_process">
        <input type="submit" class="btn btn-danger" value="Delete">
    </form>

</main>

<?php require_once '../view/footer.php'; ?>
