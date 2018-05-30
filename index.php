
<?php
require_once(__DIR__.'/Classes/User.php');
include 'navbar.php';

$user = new User();
if(!isset($_SESSION)){ session_start(); }
$user_id=0;
if (!empty($_SESSION['userObj']) && isset($_SESSION['userObj'])){
    $userObj = $_SESSION['userObj'];
    $user_id = $userObj->getUserID();
}
?>


    <div class="container-fluid">
        <div class="row">
            <?php
                $books = $user->retrieveAllBooks();
                while($book = $books->fetch_assoc()){
            ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="<?php echo $book['poster']; ?>" style="max-height: 150px" class="img-responsive" alt="...">
                            <div class="caption">
                                <h3><?php echo $book['book_name']; ?></h3>
                                <strong>Auther: <?php echo $book['author_name']; ?></strong><br>
                                <strong>Genre</strong> <?php echo $book['category']; ?><br>
                                <strong>Published</strong><?php echo $book['publication_date']; ?></br>
                                    <?php
                                        if($user->is_borrowed($book['id'])){?>
                                            <button class="btn btn-outline-primary pull-right" disabled>Not available</button>
                                            <?php
                                                $info = $user->info_about_borrowed_book($book['id']);
                                                $info = $info->fetch_assoc();?>
                                                available on: <strong class="primary"><?php echo $info['date_to'] ; ?></strong>
                                        <?php }else{ ?>
                                            <a href="actions/borrow.php?userid=<?php echo $user_id; ?>&bookid=<?php echo $book['id']; ?>"
                                                id="borrow" class="btn btn-outline-primary pull-right"
                                                role="button">Borrow</a>
                                        <?php } ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
<script>
    $('.caption #borrow').on('click', function(e){
        e.preventDefault();
        $.ajax({
            method: 'GET',
            url: $(this).attr('href')
        }).done(function(msg){
            if(msg === 'true'){
                
                $(e.target).after('<button class="btn btn-outline-primary pull-right" disabled>Not available</button>');
                $(e.target).remove();
            }
            else
                window.location.href = 'login.php';
        });
    });
</script>
