<?php
if (isset($_GET['id'])){
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $post = User::getByPage($page, 10);
}
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
