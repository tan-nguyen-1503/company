<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
$_category_list = Category::getAll();
// display a table show all category, edit name & delete, add new
?>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
