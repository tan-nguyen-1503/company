<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";
?>

<form action="" style="text-align: center;" id="create-form">
    <label for="inputName" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Post title</label> <br>
    <input style="width: 500px; margin-left: 20px; border-radius: 6px; height: 36px; box-shadow: 7px 7px 7px 7px #666666; padding-left: 5px;" type="text" name="title" id="inputName">
    <br>
    <label for="mo-ta" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Content</label> <br>

    <div class="row">
        <div class="col-sm-12 text-left">
            <div class="card-box">
                <textarea id="summernote" name="content" required></textarea>
            </div>
        </div>
    </div>
    <br>
    <input type="file" name="image" id ="image" style="width: 500px; margin-left: 20px; border-radius: 6px; height: 40px; box-shadow:7px 7px 7px 7px #666666;">
    <br><br>
    <button style="width: 500px; margin-left: 20px; border-radius: 6px; height: 40px; box-shadow:7px 7px 7px 7px #666666; padding-left: 5px;" type="submit">Create a post</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="mb-10"></div>

<script>
    $('#create-form').submit(function (e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "post.php",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),
            async: false,

            complete: function (xhr, status){
                if (status !== 'error'){
                    uploadFile(xhr.responseText);
                } else {
                    console.log(xhr.responseText());
                }
            }
        });
    });

    function uploadFile(id){
        const file_data = $('#image')[0].files[0];
        const extension = file_data.type;
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
        if (!validImageTypes.includes(extension)){
            alert("Invalid image file type");
            return ;
        }
        const form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('id', id);

        $.ajax({
            type: "POST",
            dataType: "application/json",
            url: "post.php",
            contentType: false,
            processData: false,
            data: form_data,
            preventDefault: true,

            complete: function (xhr, status){
                if (status !== 'error'){
                    alert("Upload successfully");
                } else {
                    alert("Fail to upload image");
                }
            }
        });
    }
</script>

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

