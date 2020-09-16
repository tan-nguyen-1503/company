<?php
$post = Post::getById($_GET['id']);
if ($post->is_active){
    include 'LayOut/header.php';
    include 'model/PostComment.php';
    $comment_list = PostComment::getByPostByPage($post->id, 0, 100);
    ?>

    <div class="container">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg">

                <!-- Title -->
                <h1 class="mt-4"><?php echo $post->title ?></h1>

                <!-- Author -->
                <p class="lead">by <strong><?php echo $post->author?></strong></p>

                <p>Posted at <i><?php echo $post->date?></i></p>

                <hr>
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="Public/images/post/<?php echo $post->image?>" alt="">

                <!-- Post Content -->
                <div>
                    <?php echo htmlentities($post->content)?>
                </div>

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
                                <input name="post_id" value="<?php echo $post->id?>" hidden>
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
            </div>
        </div>
        <!-- /.row -->
    </div>

    <?php if (isset($_SESSION['userId'])){
        include_once "model/User.php";
        $user = User::getById($_SESSION['userId']);
        ?>
    <script>
        $('#post-comment').submit(function (e){
           e.preventDefault();
           $.ajax({
               url: "post_comment.php",
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
