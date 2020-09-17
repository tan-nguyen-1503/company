<?php
include 'LayOut/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 0;
if (isset($_GET['categoryId'])){
    $categoryId = $_GET['categoryId'];
    $product_list = Product::getByCategoryByPage($categoryId, $page, 10);
    $count = Product::countByCategory($categoryId);
}
else {
    $product_list = Product::getActiveByPage($page, 10);
    $count = Product::countAll();
}
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
        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <?php
            foreach ($product_list as $product){
            ?>
                <div class="col-lg-4 col-md-4 col-sm-4  col-6  d-flex justify-content-center ">
                    <div class="card" style="height: 24rem;">
                        <img src="Public/images/products/<?php echo $product->image ?>"  class="card-img-top" title="<?php echo $product->product_name ?>">
                        <div class="card-body">
                            <p class="card-text text-justify"><a href="product.php?id=<?php echo $product->id ?>" class="product_name" ><?php echo $product->product_name?></a></p>
                            <p class="text-justify price"><?php echo $product->price?><sup style="text-decoration:underline"> đ</sup></p>
                            <div class="start">
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
        </div>
    </div>
</div>


</div>



<?php
include 'LayOut/footer.php';
?>
