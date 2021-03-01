<?php require_once '../view/header.php'; ?>

<main>
    <?php
        if ($emailError) {
            echo '<h4 style="color:red;">The provided email is already in use</h4>';
        }
    ?>

    <form action="user_manager/index.php" method="post">
        <input type="hidden" name="controllerRequest" value="user_profile_process">
        <input type="text" name="firstName" placeholder="First Name" value="<?php echo $user->getFirstName(); ?>"><br>
        <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $user->getLastName(); ?>"><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo $user->getEmail(); ?>"><br>
        <input type="password" name="password" placeholder="Password" value="<?php echo $user->getPassword(); ?>"><br>
        <input type="submit" value="Update">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
