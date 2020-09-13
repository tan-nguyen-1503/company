<?php
include '../model/Branch.php';
$page = $_GET['page'];
if (!isset($page))
    $page = 0;
$_branch_list = Branch::getActiveByPage($page, 10);

include '../LayOut/header.php';
?>

<!--list all branches in contact page;-->

<?php
include '../LayOut/footer.php';
?>
