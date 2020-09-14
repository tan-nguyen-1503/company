<?php
include 'LayOut/header.php';

$page = isset($page) ? $page = $_GET['page'] : 0;
$_branch_list = Branch::getActiveByPage($page, 10);
?>

<!--list all branches in contact page;-->

<?php
include 'LayOut/footer.php';
?>
