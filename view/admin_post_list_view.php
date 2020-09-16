<?php
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$_post_list = Post::getAllByPage($page, 10);

include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
