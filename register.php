<?php
    include 'navbar.php';
    if (!empty($_SESSION['userObj']) && isset($_SESSION['userObj'])){
        header("Location: index.php");   
    }
?>
    <div class="container">
        <div class="row">
            <form class="form" method="post" action="actions/registration.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" id="name" placeholder="Name" required="required">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required="required">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="conPassword" placeholder="Confirm password" required="required">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required="required">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required="required">
                </div>
                    <input name="registrationbtn" type="submit" class="btn btn-primary" id="send" value="Register" >
            </form>
        </div>
    </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- fullpage -->
    <script src="js/jquery.fullPage.js"></script>
    <!-- smoothScroll -->
    <script src="js/smoothscroll.js"></script>
    <!-- wow -->
    <script src="js/wow.min.js"></script>
    <!-- text rotater -->
    <script src="js/jquery.simple-text-rotator.js"></script>
    <!-- custom -->
    <script src="js/custom.js"></script>