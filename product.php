<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    require 'util.php';
    if (isset($_GET['id']))
        include 'view/product_detail_view.php';
    else
        include 'view/product_list_view.php';
}
else{
    http_response_code(405);
}
?>
