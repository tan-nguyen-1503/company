<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
$id = 0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $category = Category::getById($id);
}
?>


</div>
</div>
</div>
</div>

</div>
</div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>

