<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";
$category_list = Category::getAll();
?>

<div class="col-12 col-md-8 col-lg-9" style="background-color: #F4F4F3;">
    <div class="shop_post_area mt-2">
        <div class="row">
            <div class="col-12 d-none d-md-block">
                <div class="post-topbar d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="item owl-carousel owl-theme">
                    <table style="width: 100%;" border="1">
                        <tr>
                            <td style="width: 20%; font-weight: 600;">Id</td>
                            <td style="width: 20%; font-weight: 600;">Category</td>
                        </tr>

                        <?php foreach ($category_list as $category){
                            ?>

                            <tr>
                                <td><?php echo $category->id?></td>
                                <td><a href="category.php?id=<?php echo $category->id?>"><?php echo $category->category?></td>
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
