<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";
$category_list = Category::getAll();
?>

<form action="" style="text-align: center;" id="create-form">
    <label for="inputName" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Category</label> <br>
    <input style="width: 500px; margin-left: 20px; border-radius: 6px; height: 36px; box-shadow: 7px 7px 7px 7px #666666; padding-left: 5px;" type="text" name="category" id="inputName">
    <br><br>
    <button style="width: 500px; margin-left: 20px; border-radius: 6px; height: 40px; box-shadow:7px 7px 7px 7px #666666; padding-left: 5px;" type="submit">Create category</button>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
    $('#create-form').submit(function (e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "category.php",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),
            async: false,

            complete: function (xhr, status){
                if (status !== 'error'){
                } else {
                    $("#error").html(xhr.responseText);
                }
            }
        });
    });
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>

