<?php require_once '../view/header.php'; ?>

<main>
    <?php
    if ($emailError) {
        echo '<h4 style="color:red;">The provided email is already in use</h4>';
    }
    ?>
    <div>
        <form action="user_manager/index.php" method="post">
            <input type="hidden" name="controllerRequest" value="user_profile_process">
            <input type="text" name="firstName" placeholder="First Name" value="<?php echo $user->getFirstName(); ?>"><br>
            <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $user->getLastName(); ?>"><br>
            <input type="email" name="email" placeholder="Email" value="<?php echo $user->getEmail(); ?>"><br>

            <input type="hidden" name="password" value="<?php echo $user->getPassword(); ?>">

            <input type="submit" class="btn btn-secondary" value="Update User Information">
        </form>
        <br>
        <form action="user_manager/index.php" method="post">
            <?php
            if ($badVerifyPassword) {
                echo '<h4 style="color:red;">Old password could not be verified. Please try again.</h4>';
            }
            ?>
            <input type="hidden" name="controllerRequest" value="user_password_change_process">
            <input type="password" name="passVerify1" placeholder="Password"><br>
            <input type="password" name="passVerify2" placeholder="Verify Password"><br>

            <input type="password" name="newPassword" placeholder="New Password"><br>

            <input type="submit" class="btn btn-secondary" value="Update Password">
        </form>
        <br>
        <form action="user_manager/index.php" method="post">
            <?php
            if ($badDeletePassword) {
                echo '<h4 style="color:red;">The password entered was incorrect.</h4>';
            }
            ?>
            <input type="hidden" name="controllerRequest" value="user_delete_process">

            <input type="password" name="password" placeholder="Password"><br>

            <input type="submit" class="btn btn-danger" value="Delete User Account">
        </form>
    </div>
</main>

<?php require_once '../view/footer.php'; ?>
