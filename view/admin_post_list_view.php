<?php
$post_list = Post::getAll();

include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";

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
                            <td style="width: 20%; font-weight: 600;">Title</td>
                            <td style="width: 20%; font-weight: 600;">Author</td>
                            <td style="width: 20%; font-weight: 600;">Post date</td>
                            <td style="width: 20%; font-weight: 600;">Is Active</td>
                        </tr>

                        <?php foreach ($post_list as $post){
                            ?>

                            <tr>
                                <td><?php echo $post->id?></td>
                                <td><a href="post.php?id=<?php echo $post->id?>"><?php echo $post->title?></td>
                                <td><?php echo $post->author?></td>
                                <td><?php echo $post->date?></td>
                                <td><?php echo $post->is_active?></td>
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
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>

