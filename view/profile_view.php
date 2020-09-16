<?php
include 'LayOut/header.php';

$user = User::getById($_SESSION['userId']);
?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4 bg-light pb-5" style="min-height: 80vh">
            <div class="row mt-5 d-flex justify-content-center" >
                <img class="col-lg-5 " id="avatar-img" src="Public/images/user-images/<?php echo $user->avatar?>" alt="user_image" style="width:80%;border-radius:50%">
            </div>

            <div class="row mt-2 d-flex justify-content-center" >
                <h3><?php echo $user->name?> <img src="https://img.icons8.com/nolan/32/000000/checked-checkbox.png"></h3>
            </div>

            <div class="row mt-2 d-flex justify-content-left  p-3" >
                <div style="margin-left:80px"><a href="#" style="text-decoration:none;font-weight:700;color:black" id="ACCOUNT"><img src="https://img.icons8.com/nolan/32/000000/user-male.png">ACCOUNT </a></div>
            </div>
            <div class="row mt-2 d-flex justify-content-left  p-3" >
                <div style="margin-left:80px"><a href="#" style="text-decoration:none;font-weight:700;color:black" id="PASSWORD"><img src="https://img.icons8.com/nolan/32/000000/privacy.png">PASSWORD</a></div>
            </div>
            <div class="row mt-2 d-flex justify-content-left  p-3" >
                <div style="margin-left:80px"><a href="#" style="text-decoration:none;font-weight:700;color:black" id="AVATAR"><img src="https://img.icons8.com/nolan/32/000000/change-user-male.png">AVATAR</a></div>
            </div>

            <div class="row mt-2 d-flex justify-content-left  p-3" >
                <div style="margin-left:80px"><a href="../logout.php" style="text-decoration:none;font-weight:700;color:black"><img src="https://img.icons8.com/nolan/32/000000/exit.png">LOG OUT </a></div>
            </div>
        </div>
        <div class="col-lg-4 bg-light pb-3" id="update_account">
            <h3 class="mt-5 d-flex justify-content-center text-primary " >ACCOUNT</h3>
            <p style="color:green;font-weight:700" id="account-success"></p>
            <p style="color:red;font-weight:700" id="account-error"></p>
            <form id="update-form" class="mt-3">
                <div class="form-group">
                    <label for="name_user" style="font-weight:600">NAME</label>
                    <input type="text" class="form-control" name="name" value=<?php echo $user->name ?>>
                </div>
                <div class="form-group">
                    <label for="email_user" style="font-weight:600">EMAIL</label>
                    <input type="email" class="form-control" name="email_user" disabled value=<?php echo $user->email ?> >
                </div>
                <div class="form-group">
                    <label for="dob" style="font-weight:600">BIRTH DAY</label>
                    <input type="text" class="form-control" name="date_of_birth" value=<?php echo $user->date_of_birth ?> >
                </div>
                <button type="submit" class="btn btn-primary" name="btn_update_user" >UPDATE</button>
            </form>
        </div>

        <div class="col-lg-4 bg-light" id="update_password" style="display:none">
            <h3 class="mt-5 d-flex justify-content-center text-primary" >UPDATE PASSWORD</h3>
            <p style="color:green;font-weight:700" id="password-success"></p>
            <p style="color:red;font-weight:700" id="password-error"></p>
            <form id="change-password-from" class="mt-3">
                <div class="form-group">
                    <label for="password" style="font-weight:600">PASSWORD</label>
                    <input type="password" class="form-control" name="oldPassword">
                </div>
                <div class="form-group">
                    <label for="new_password" style="font-weight:600">NEW PASSWORD</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="re_new_password" style="font-weight:600">REPEAT NEW PASSWORD</label>
                    <input type="password" class="form-control" name="confirmPassword">
                </div>
                <button type="submit" class="btn btn-primary" >CHANGE</button>
            </form>
        </div>

        <div class="col-lg-4 bg-light" id="update_avatar" style="display:none">
            <h3 class="mt-5 d-flex justify-content-center text-primary" >UPDATE AVATAR</h3>
            <p style="color:green;font-weight:700" id="avatar-success"></p>
            <p style="color:red;font-weight:700" id="avatar-error"></p>
            <form id="update-avatar-from" class="mt-3" method="POST">
                <div class="form-group">
                    <label for="file" style="font-weight:600">Choose your avatar</label>
                    <input type="file" class="form-control" name="file" id="file">
                </div>
                <button type="submit" class="btn btn-primary" >UPLOAD</button>
            </form>
        </div>


    </div>
</div>
<script>
    $(document).ready(function(){
        $('#ACCOUNT').click(function(){
            $('#update_account').show();
            $('#update_password').hide();
            $('#update_avatar').hide();
        })
        $('#PASSWORD').click(function(){
            $('#update_account').hide();
            $('#update_password').show();
            $('#update_avatar').hide();
        })
        $('#AVATAR').click(function(){
            $('#update_account').hide();
            $('#update_password').hide();
            $('#update_avatar').show();
        })
    });

    $('#update-form').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: "profile.php",
            type: "POST",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),

            complete: function (xhr, status){
                if (status !== 'error'){
                    $("#account-success").html(xhr.responseText);
                    $("#account-error").empty();
                } else {
                    $("#account-error").html(xhr.responseText);
                    $("#account-success").empty();
                }
            }
        });
    });

    $('#change-password-from').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: "profile.php",
            type: "PUT",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),

            complete: function (xhr, status){
                if (status !== 'error'){
                    $("#password-success").html(xhr.responseText);
                    $("#password-error").empty();
                } else {
                    $("#password-error").html(xhr.responseText);
                    $("#password-success").empty();
                }
            }
        });
    });

    $('#update-avatar-from').submit(function (e){
        e.preventDefault();
        const file_data = $('#file')[0].files[0];
        const extension = file_data.type;
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (!validImageTypes.includes(extension)){
            $("#account-error").html("Invalid image file type");
            $("#account-success").empty();
            return ;
        }

        const form_data = new FormData();
        form_data.append('file', file_data);

        $.ajax({
            url: "profile.php",
            type: "POST",
            dataType: "application/json",
            contentType: false,
            processData: false,
            data: form_data,

            complete: function (xhr, status){
                if (status !== 'error'){
                    // $("#account-success").html(xhr.responseText);
                    $("#account-error").empty();
                    $("#avatar-img").attr("src", "Public/images/user-images/" + xhr.responseText);
                    $("#avatar-img").show();
                } else {
                    $("#avatar-error").html(xhr.responseText);
                    $("#avatar-success").empty();
                }
                // avatar.val('');
            }
        });
    });


</script>


<?php
include 'LayOut/footer.php';
?>
