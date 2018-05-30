
    <?php
    include 'navbar.php';
    if (!empty($_SESSION['userObj']) && isset($_SESSION['userObj'])){
        header("Location: index.php");
    }
    ?>
    <div class="container">
        <div class="row">
            <form method="post" action="actions/login.php">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name ="email" class="form-control"  required="required" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name = "password" type="password" class="form-control" required="required" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button name="loginbtn" type="submit" class="btn btn-primary">Login</button>

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