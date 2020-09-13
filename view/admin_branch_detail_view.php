<?php
//create / edit a branch
$id = 0;
if (isset($_GET['id'])){
    include '../model/Branch.php';
    $id = $_GET['id'];
    $post = Branch::getById($id);
}
//check id = 0 -> create, else -> edit (display data, function = update)
