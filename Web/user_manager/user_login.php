<?php require_once '../view/header.php'; ?>

<main>
    <?php
    if ($badLogin) {
        echo '<h4 style="color:red;">The email or password you entered was incorrect</h4>';
    }
    ?>
    <div class="multiForm">
        <form action="user_manager/index.php" method="post" id="userLogin">
            <input type="hidden" name="controllerRequest" value="user_login_process">

            <input type="email" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>
        <br>
        <form action="user_manager/index.php" method="post">
            <input type="hidden" name="controllerRequest" value="user_login_process">

            <input type="text" name="email" value="testadmin@test.com" disabled><br>
            <input type="text" name="password" value="admin" disabled><br>

            <input type="hidden" name="email" value="testadmin@test.com">
            <input type="hidden" name="password" value="admin">

            <input type="submit" class="btn btn-secondary" value="Test Admin Login">
        </form>
        <br>
        <form action="user_manager/index.php" method="post">
            <input type="hidden" name="controllerRequest" value="user_login_process">

            <input type="text" name="email" value="testuser@test.com" disabled><br>
            <input type="text" name="password" value="user" disabled><br>

            <input type="hidden" name="email" value="testuser@test.com">
            <input type="hidden" name="password" value="user">

            <input type="submit" class="btn btn-secondary" value="Test User Login">
        </form>
</main>

<?php require_once '../view/footer.php'; ?>
