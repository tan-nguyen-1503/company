<?php
include 'LayOut/header.php';

include 'model/Product.php';
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$product_list = Product::getActiveByPage($page, 10);
?>

<?php
include 'LayOut/footer.php';
?>
