<?php
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$product_list = Product::getAllByPage($page, 100);
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";
?>

<div class="col-12 col-md-8 col-lg-9" style="background-color: #F4F4F3;">
    <div class="shop_product_area mt-2">
        <div class="row">
            <div class="col-12 d-none d-md-block">
                <div class="product-topbar d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="item owl-carousel owl-theme">
                    <table style="width: 100%;" border="1">
                        <tr>
                            <td style="width: 20%; font-weight: 600;">id</td>
                            <td style="width: 20%; font-weight: 600;">Name</td>
                            <td style="width: 20%; font-weight: 600;">Category</td>
                            <td style="width: 20%; font-weight: 600;">Is Active</td>
                            <td style="width: 20%; font-weight: 600; text-align: right;">Price</td>
                        </tr>

                        <?php foreach ($product_list as $product){
                           ?>

                            <tr>
                                <td><?php echo $product->id?></td>
                                <td><a href="product.php?id=<?php echo $product->id?>"><?php echo $product->product_name?></td>
                                <td><?php echo $product->category?></td>
                                <td><?php echo $product->is_active?></td>
                                <td style="text-align: right;"><?php echo $product->price?></td>
                            </tr>
                        <?php
                        }?>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
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
