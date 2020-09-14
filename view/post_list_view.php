<?php
include 'LayOut/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 0;
$post_list = Post::getActiveByPage($page, 10);
?>

<?php
include 'LayOut/footer.php';
?>
