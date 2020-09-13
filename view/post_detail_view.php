<?php
include 'model/Post.php';
$post = Post::getById($_GET['id']);
if ($post->is_active){
    include 'LayOut/header.php';
    ?>

    <?php
    if (isset($_SESSION['userId'])){
        // display form to add comment
        // ajax script to add comment
    }

    //ajax to show comment (GET -> postId & page)
    // showmore -> load more comment
    ?>

    <?php
    include 'LayOut/footer.php';
    ?>

    <?php
} else {
    http_response_code(400);
}
?>
