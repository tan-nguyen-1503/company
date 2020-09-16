<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
$data = json_decode(file_get_contents("php://input", "r"));
$about = About::getAbout();
?>

<style type="text/css"> @import url("../Public/summernote-0.8.18-dist/summernote-bs4.min.css"); </style>
<script src="../Public/summernote-0.8.18-dist/summernote-bs4.min.js"></script>

<form id="about-form" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-b-30 m-t-0 m-b-5 header-title"><b>About</b></h4>
                <textarea id="summernote" name="about" required><?php echo htmlentities($about->about)?></textarea>
            </div>
        </div>
    </div>
    <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update and Post</button>
</form>
<script>
    $('#about-form').submit(function (e){
        e.preventDefault();
        $.ajax({
            // url: "about-us.php",
            type: "PUT",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),

            complete: function (xhr, status){
                if (status !== 'error'){
                    // location.href = "index.php";
                } else {
                    $("#error").html(xhr.responseText);
                }
            }
        });
    });
</script>

<!--<div id="summernote"></div>-->
<script>
    $('#summernote').summernote({
        width: 800,
        height: 500,
        focus: false
    });
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
