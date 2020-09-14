<?php
if (isset($_GET['id'])){
    include '../model/User.php';
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $post = User::getByPage($page, 10);
}
