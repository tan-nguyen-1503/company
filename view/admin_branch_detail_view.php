<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';

$id = 0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $post = Branch::getById($id);

}
//check id = 0 -> create, else -> edit (display data, function = update)
?>



<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
