<?php
include '../model/Category.php';
$_category_list = Category::getAll();
// display a table show all category, edit name & delete, add new
