<?php
//edit user, can only edit password & isActive
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $post = User::getById($id);
}
