<!DOCTYPE html>
<html>

<head>
    <title>AppsDev - Sluiter</title>

    <base href="http://jordan1.nritweb.com/">

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery -->
    <script src="addons/jquery/jquery.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="javascript/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <script src="javascript/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="addons/bootstrap/css/bootstrap.min.css">
    <script src="addons/bootstrap/js/bootstrap.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="addons/bootstrap-icons/bootstrap-icons.css">

    <!-- Slick (image spinner thing) -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Calendar Heatmap -->
    <link rel="stylesheet" type="text/css" href="addons/calendar-heatmap/Calendar-Heatmap-Plugin/dist/jquery.CalendarHeatmap.css" />
    <script src="addons/calendar-heatmap/moment.js"></script>
    <script src="addons/calendar-heatmap/Calendar-Heatmap-Plugin/dist/jquery.CalendarHeatmap.js"></script>

    <!-- Custom -->
    <link rel="stylesheet" href="style/custom.css">
    <script src="javascript/main.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
            <a class="navbar-brand" href="index.php">Pet Tracker</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="user_manager?controllerRequest=user_profile">
                            <?php $user = unserialize($_SESSION['user']);
                            echo $user->getFirstName(); ?>'s Profile
                        </a>
                        <a class="nav-link" href="user_manager?controllerRequest=user_logout">Log Out</a>
                    </div>
                <?php endif; ?>
            </nav>
        </nav>
    </header>
