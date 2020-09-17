<?php
$product = Product::getById($_GET['id']);
if ($product->is_active){
    include 'LayOut/header.php';
    include_once "model/ProductComment.php";
    $comment_list = ProductComment::getByProductByPage($product->id, 0, 100);
?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container">
            <li class="breadcrumb-item"><a href="index.php" style="color: black">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </nav>

<main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <img src="Public/images/products/<?php echo $product->image?>" class="img-fluid" alt="">
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <!--Content-->
                <div class="p-4">
                    <div class="mb-3">
                        <a href="">
                            <span class="badge purple mr-1"><?php echo $product->category ?></span>
                        </a>
                        <a href="">
                            <span class="badge blue mr-1">New</span>
                        </a>
                        <a href="">
                            <span class="badge red mr-1">Bestseller</span>
                        </a>
                    </div>

                    <p class="lead">
                        <span><?php echo $product->price ?> đ</span>
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <p><?php echo $product->description?></p>

                    <p>Rating: <?php echo $product->rating?> (<?php echo $product->count_rating?> votes)</p>
                </div>
                <!--Content-->

            </div>
            <!--Grid column-->


        </div>
        <!--Grid row-->
    </div>
</main>

    <hr>

    <!-- Comments Form -->
    <?php
    if (isset($_SESSION['userId'])){
        ?>
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form id="post-comment">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment" id="comment-create"></textarea>
                    </div>
                    <input name="product_id" value="<?php echo $product->id?>" hidden>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <?php
    }
    ?>

    <div id="comment-section">
        <?php
        foreach ($comment_list as $comment){
            ?>
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0 mb-0"><?php echo $comment->user ?></h5>
                    <i><small>at <?php echo $comment->comment_time ?></small></i>
                    <p class="mt-2"><?php echo $comment->comment ?></p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <?php if (isset($_SESSION['userId'])){
        include_once "model/User.php";
        $user = User::getById($_SESSION['userId']);
        ?>
        <script>
            $('#post-comment').submit(function (e){
                e.preventDefault();
                $.ajax({
                    url: "product_comment.php",
                    type: "POST",
                    dataType: "application/json",
                    data: $(this).serializeFormJSON(),

                    complete: function (xhr, status){
                        if (status !== 'error'){
                            $(this).trigger("reset");
                            const comment = $("#comment-create").val();
                            const userName= "<?php echo $user->name ?>";
                            const d = new Date();
                            const date = d.toISOString().split("T")[0];
                            const time = d.toTimeString().split(" ")[0];
                            const dt = date + " " + time;

                            $("#comment-section").prepend(
                                '<div class="media mb-4">' +
                                '<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">' +
                                '<div class="media-body">' +
                                '<h5 class="mt-0 mb-0">' + userName + '</h5>' +
                                '<i><small>at ' + dt + '</small></i>' +
                                '<p class="mt-2">' + comment + '</p>' +
                                '</div>' +
                                '</div>'
                            );
                        } else {
                            $("#error").html(xhr.responseText);
                        }
                        $("#comment-create").val("");
                    }
                })
            });
        </script>
    <?php }?>

    <?php
    include 'LayOut/footer.php';
    ?>

    <?php
} else {
    http_response_code(400);
}
?>
