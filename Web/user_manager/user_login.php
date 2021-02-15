<?php require_once '../view/header.php'; ?>

<main>
    <?php
        if ($badLogin) {
            echo '<h4 style="color:red;">The email or password you entered was incorrect</h4>';
        }
    ?>

    <form action="user_manager/index.php" method="post" id="user">
        <input type="hidden" name="controllerRequest" value="user_login_process">

        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" value="Go">
    </form>
</main>

<?php require_once '../view/footer.php'; ?>
