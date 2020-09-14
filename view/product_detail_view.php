<?php
$product = Product::getById($_GET['id']);
if ($product->is_active){

    include 'LayOut/header.php';
    ?>


    <?php
    if (isset($_SESSION['userId'])){
        // display form to add comment
        // ajax script to add comment
    }

    //ajax to show comment (GET -> productId & page)
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
