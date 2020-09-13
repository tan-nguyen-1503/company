<?php
//create / edit a product
$id = 0;
if (isset($_GET['id'])){
    include '../model/Product.php';
    $id = $_GET['id'];
    $post = Product::getById($id);
}
//check id = 0 -> create, else -> edit (display data, function = update)
