<?php
if (isset($_GET['id'])){
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $post = User::getByPage($page, 10);
}
