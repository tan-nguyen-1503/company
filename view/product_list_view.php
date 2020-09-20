<?php
include 'LayOut/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = 6;

if (isset($_GET['categoryId'])){
    $categoryId = $_GET['categoryId'];
    $product_list = Product::getByCategoryByPage($categoryId, $page - 1, $pageSize);
    $total = Product::countByCategory($categoryId);
}
else {
    $product_list = Product::getActiveByPage($page - 1, $pageSize);
    $total = Product::countAllActive();
}

$num_page = ceil($total / $pageSize);
?>

<!-- Begin Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb container">
        <li class="breadcrumb-item"><a href="index.php" style="color: black">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
    </ol>
</nav>
<!-- End Breadcrumb Area-->

<div class="container">
    <div class="row">
<!--        <div class="col-lg-8 col-md-12 col-sm-12 col-12">-->
            <?php
            foreach ($product_list as $product){
            ?>
                <div class="col-lg-4 col-md-4 col-sm-4  col-6  d-flex justify-content-center">
                    <div class="card">
                        <img src="Public/images/products/<?php echo $product->image ?>"  class="card-img-top" title="<?php echo $product->product_name ?>">
                        <div class="card-body">
                            <p class="card-text text-center"><a href="product.php?id=<?php echo $product->id ?>" class="product_name" ><?php echo $product->product_name?></a></p>
                            <p class="text-center align-content-center price"><?php echo $product->price?><sup style="text-decoration:underline"> đ</sup></p>
                            <div class="star">
                                <?php for($i = 0; $i < $product->rating;$i++):?>
                                    <span class="fa fa-star checked"></span>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>
<!--        </div>-->
    </div>

    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4 mt-3">
        <li class="page-item"><a href="?page=1<?php if (isset($categoryId)) {echo "&categoryId=" .$categoryId;} ?>" class="page-link">First</a></li>
        <li class="<?php if($page == 1){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($page == 1) { echo '#'; } else { echo "?page=" .($page - 1); if (isset($categoryId)) {echo "&categoryId=" .$categoryId;} } ?>" class="page-link">Prev</a>
        </li>
        <li class="<?php if($page >= $num_page){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($page >= $num_page){ echo '#'; } else { echo "?page=".($page + 1); if (isset($categoryId)) {echo "&categoryId=" .$categoryId;} } ?> " class="page-link">Next</a>
        </li>
        <li class="page-item"><a href="?page=<?php echo $num_page; if (isset($categoryId)) {echo "&categoryId=" .$categoryId;} ?>" class="page-link">Last</a></li>
    </ul>
</div>

<?php
include 'LayOut/footer.php';
?>
