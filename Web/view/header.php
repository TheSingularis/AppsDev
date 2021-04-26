<!DOCTYPE html>
<html>

<head>
    <title>AppsDev - Sluiter</title>

    <base href="http://192.168.1.59/">

    <!-- Jquery -->
    <!--<link rel="stylesheet" href="javascript/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <script src="javascript/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>-->
    <script src="addons/jquery/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="addons/bootstrap/css/bootstrap.min.css">
    <script src="addons/bootstrap/js/bootstrap.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="addons/bootstrap-icons/bootstrap-icons.css">

    <!-- Slick (image spinner thing) -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Popper -->
    <script src="addons/popper.js/popper.min.js"></script>

    <!-- Custom -->
    <link rel="stylesheet" href="style/custom.css">
    <script src="javascript/main.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
            <a class="navbar-brand" href="index.php">Pet Tracker</a>
            <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if (!isset($_SESSION['user'])) : ?>
                <div class="navbar-nav mr-auto">
                    <a class="nav-link" href="index.php">Home</a>
                </div>
                <div class="navbar-nav navbar-right">
                    <a class="nav-link" href="user_manager?controllerRequest=user_add">Register</a>
                    <a class="nav-link" href="user_manager?controllerRequest=user_login">Log In</a>
                </div>
            <?php else : ?>
                <div class="navbar-nav mr-auto">
                    <a class="nav-link" href="list_manager">ToDo Lists</a>
                </div>
                <div class="navbar-nav navbar-right">
                    <a class="nav-link" href="user_manager?controllerRequest=user_profile">User Profile</a>
                    <a class="nav-link" href="user_manager?controllerRequest=user_logout">Log Out</a>
                </div>
            <?php endif; ?>
            </nav>
        </nav>
    </header>
    
    <!-- Pre Bootstrap
    <header>
        <h1 id="header">
            AppsDev - Sluiter
        </h1>

        <h2>
            <?php if (isset($_SESSION['user'])) {
                $user = unserialize($_SESSION['user']);                
                echo 'Welcome ' . $user->getFullName();
            }
            ?>
        </h2>

        <nav id="nav_menu">
            <?php if (!isset($_SESSION['user'])) : ?>
                <ul class="left">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="user_manager?controllerRequest=user_add">Register</a></li>
                    <li><a href="user_manager?controllerRequest=user_login">Log In</a></li>
                </ul>
            <?php else : ?>
                <ul>
                    <li><a href="list_manager">ToDo Lists</a></li>
                    <li><a href="user_manager?controllerRequest=user_profile">User Profile</a></li>
                    <li><a href="user_manager?controllerRequest=user_logout">Log Out</a></li>
                </ul>
            <?php endif; ?>
        </nav>
    </header>
    -->
