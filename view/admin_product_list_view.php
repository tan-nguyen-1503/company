<?php
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$_product_list = Product::getAllByPage($page, 10);

include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
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
