<?php
include '../model/Product.php';
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$_product_list = Product::getAllByPage($page, 10);
