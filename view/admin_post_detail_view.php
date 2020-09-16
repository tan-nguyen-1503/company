<?php
//create / edit a post
$id = 0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $post = Post::getById($id);
}
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';

//check id = 0 -> create, else -> edit (display data, function = update)
?>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
