<?php
include 'LayOut/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 0;
if (isset($_GET['categoryId'])){
    $categoryId = $_GET['categoryId'];
    $product_list = Product::getByCategoryByPage($categoryId, $page, 10);
    $count = Product::countByCategory($categoryId);
}
else {
    $product_list = Product::getActiveByPage($page, 10);
    $count = Product::countAll();
}
?>

<?php
include 'LayOut/footer.php';
?>
