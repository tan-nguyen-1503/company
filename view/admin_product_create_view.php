<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/header.php';
include_once "../LayOut/leftContentAccess.php";
include_once "../model/Category.php";
$category_list = Category::getAll();
?>

<form action="" style="text-align: center;" id="create-form">
    <label for="inputName" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Product name</label> <br>
    <input style="width: 500px; margin-left: 20px; border-radius: 6px; height: 36px; box-shadow: 7px 7px 7px 7px #666666; padding-left: 5px;" type="text" name="product_name" id="inputName">
    <br>
    <label for="mo-ta" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Description</label> <br>
    <textarea  style="width: 500px; margin-left: 20px; border-radius: 6px; height: 160px; box-shadow:7px 7px 7px 7px #666666; padding-left: 5px;" name="description" id="mo-ta" cols="30" rows="10"></textarea>
    <br>
    <label for="price" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Giá sản phẩm</label> <br>
    <input style="width: 500px; margin-left: 20px; border-radius: 6px; height: 36px; box-shadow:7px 7px 7px 7px #666666; padding-left: 5px;" type="text" name="price" id="inputName">
    <br>
    <label for="category" style="margin: 20px 20px 5px 20px; font-weight: 600; ">Loại sản phẩm</label> <br>
    <select id="category" name="category_id" style="width: 500px; margin-left: 20px; border-radius: 6px; height: 36px; box-shadow:7px 7px 7px 7px #666666; padding-left: 5px;" placeholder="Chọn loại sản phẩm">
        <?php
        foreach ($category_list as $category){
            echo "<option value='$category->id'>$category->category</option>";
        }
        ?>
    </select>
    <br><br>
    <input type="file" name="image" id ="image" style="width: 500px; margin-left: 20px; border-radius: 6px; height: 40px; box-shadow:7px 7px 7px 7px #666666;">
    <br><br>
    <button style="width: 500px; margin-left: 20px; border-radius: 6px; height: 40px; box-shadow:7px 7px 7px 7px #666666; padding-left: 5px;" type="submit">Create product</button>
</form>

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
            url: "product.php",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),
            async: false,

            complete: function (xhr, status){
                if (status !== 'error'){
                    uploadFile(xhr.responseText);
                } else {
                    $("#error").html(xhr.responseText);
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
            url: "product.php",
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

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/LayOut/footer.php';
?>

