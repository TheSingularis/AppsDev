<?php require_once '../view/header.php'; ?>

<main>
    <?php
    if ($emailError) {
        echo '<h4 style="color:red;">The provided email is already in use</h4>';
    }
    ?>

    <form action="user_manager/index.php" method="post" id="user_add">
        <input type="hidden" name="controllerRequest" value="user_add_process">
        <input type="text" name="firstName" placeholder="First Name" class="form-control">
        <input type="text" name="lastName" placeholder="Last Name" class="form-control">
        <input type="email" name="email" placeholder="Email" class="form-control">
        <input type="password" name="password" placeholder="Password" class="form-control">
        <input type="submit" class="btn btn-primary" value="Register">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
