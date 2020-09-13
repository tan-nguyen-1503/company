<?php
include '../model/Post.php';
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$_post_list = Post::getAllByPage($page, 10);
?>
