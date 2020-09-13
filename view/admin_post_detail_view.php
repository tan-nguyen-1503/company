<?php
//create / edit a post
$id = 0;
if (isset($_GET['id'])){
    include '../model/Post.php';
    $id = $_GET['id'];
    $post = Post::getById($id);
}
//check id = 0 -> create, else -> edit (display data, function = update)


