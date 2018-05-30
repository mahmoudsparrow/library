<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <link rel="shortcut icon" href="images/logo2.png">
    <title>Mahmoud El-Shafey | Web Developer </title>

    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

</head>
<body>
    <?php
        require_once(__DIR__.'/Classes/User.php');
        if(!isset($_SESSION)){ session_start(); }
        $user = new User();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">Sparrow</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if($user->is_Logged_in()){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="my_books.php">My books</a>
                </li>
            <?php } ?>
            </ul>
            <?php
                if (empty($_SESSION['userObj']) && !isset($_SESSION['userObj'])){ ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    </ul>
                <?php }else{ ?>
                    <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <a class="btn btn-outline-danger" href="actions/logout.php">Logout</a>
                <?php } ?>
        </div>
    </nav>
</body>
</html>