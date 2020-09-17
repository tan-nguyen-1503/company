<?php
//create / edit a product
$id = 0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $post = Product::getById($id);
}
//check id = 0 -> create, else -> edit (display data, function = update)
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


