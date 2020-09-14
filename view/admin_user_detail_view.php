<?php
//edit user, can only edit password & isActive
if (isset($_GET['id'])){
    include '../model/User.php';
    $id = $_GET['id'];
    $post = User::getById($id);
}
