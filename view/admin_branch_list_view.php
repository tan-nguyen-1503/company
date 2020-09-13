<?php
include '../model/Branch.php';
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$_branch_list = Branch::getAllByPage($page, 10);
