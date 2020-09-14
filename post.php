<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    require 'util.php';
    include 'model/Post.php';
    if (isset($_GET['id']))
        include 'view/post_detail_view.php';
    else
        include 'view/post_list_view.php';
}
else{
    http_response_code(405);
}
?>
