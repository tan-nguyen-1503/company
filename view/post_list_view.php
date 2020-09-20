<?php
include 'LayOut/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pageSize = 6;
$post_list = Post::getActiveByPage($page - 1, $pageSize);
$total = Post::countAllActive();
$num_page = ceil($total / $pageSize);
?>

<!-- Begin Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb container">
        <li class="breadcrumb-item"><a href="index.php" style="color: black">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Post</li>
    </ol>
</nav>
<!-- End Breadcrumb Area-->

<div class="container">
    <div class="row">
    <!-- Post -->
    <?php
    foreach ($post_list as $post) {
        ?>
            <div class="col-sm-4">
                <div class="card-header">
                    <h5 class="card-title text-center"><?php echo $post->title ?></h5>
                </div>

                <div class="card-body">
                    <img class="card-img-top img-responsive" src="<?php echo "Public/images/post/" . $post->image . "\" alt=\"" . $post->title ?>">
<!--                    <p class="card mb-2">--><?php //echo substr($post->content, 0, 150)?><!--</p>-->
                    <p class="mb-2"><?php echo "By $post->author<br>at $post->date"?></p>
                    <a  href="post.php?id=<?php echo $post->id; ?>" class="btn btn-primary mb-5">Read More &rarr;</a>
                </div>
            </div>
    <?php } ?>
    </div>

    <!-- Pagination -->
    <ul class="pagination justify-content-center mb-4 mt-3">
        <li class="page-item"><a href="?page=1"  class="page-link">First</a></li>
        <li class="<?php if($page == 1){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($page == 1) { echo '#'; } else { echo "?page=$page";} ?>" class="page-link">Prev</a>
        </li>
        <li class="<?php if($page >= $num_page){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($page >= $num_page){ echo '#'; } else { echo "?page=".($page + 1); } ?> " class="page-link">Next</a>
        </li>
        <li class="page-item"><a href="?page=<?php echo $num_page; ?>" class="page-link">Last</a></li>
    </ul>

</div>

<?php
include 'LayOut/footer.php';
?>
