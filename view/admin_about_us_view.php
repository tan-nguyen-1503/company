<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
$data = json_decode(file_get_contents("php://input", "r"));
$about = About::getAbout();
include_once "../LayOut/leftContentAccess.php";
?>

                        <form id="about-form" method="post">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="m-b-30 m-t-0 m-b-5 header-title"><b>About</b></h4>
                                        <textarea id="summernote" name="about" required><?php echo htmlentities($about->about)?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light mt-3 mb-3">Update and Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
    </div>
</div
</div>

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
        // width: 500,
        height: 500,
        focus: false
    });
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>
