
<?php
require_once(__DIR__.'/Classes/User.php');
include 'navbar.php';

$user = new User();
if(!isset($_SESSION)){ session_start(); }
$user_id=0;
if (!empty($_SESSION['userObj']) && isset($_SESSION['userObj'])){
    $userObj = $_SESSION['userObj'];
    $user_id = $userObj->getUserID();

    // $boks = $user->retrieveMyBooks($user_id);
    // echo $boks;
    // die();
}
?>
<div class="container-fluid">
        <div class="row">
            <?php
                $books = $user->retrieveMyBooks($user_id);
                while($book = $books->fetch_assoc()){
            ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="<?php echo $book['poster']; ?>" style="max-height: 150px" class="img-responsive" alt="...">
                            <div class="caption">
                                <h3><?php echo $book['book_name']; ?></h3>
                                <p><?php echo $book['author_name']; ?></p>
                                <!-- <div class="clearfix"> -->
                                    <!-- <div class="pull-left">$ {{ $product->price }}</div> -->
                                    <?php
                                        $info = $user->info_about_borrowed_book($book['id']);
                                        $info = $info->fetch_assoc();?>
                                            Start date: <strong class="outline-primary"><?php echo $info['date_from'] ; ?></strong> |
                                            End date: <strong class="primary"><?php echo $info['date_to'] ; ?></strong>
                                        
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>

