<?php
require './LayOut/header.php';
?>

<div class="container" style="padding:150px 0px">
    <div class="row">
        <div class="imagesform col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="row d-flex flex-row justify-content-center">
                <div  class="imgdiv d-flex flex-row justify-content-center">
                    <img src="../Public/images/Account/signin-image.jpg" alt="login-image.jpg">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="signup.php" class="signup-image-link mb-2">Create An Account</a>
                </div>
            </div>
        </div>
        <div class="formpart col-lg-6 col-md-12 col-sm-12 col-12 mt-5">
            <form method="POST" class="login-form" id="login-form">
                <h2 class="form-title mb-3">Login</h2>
                <p style="color:red;font-weight:700" id="error"></p>
                <div class="form-group formElement">
                    <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;</label>
                    <input type="text" name="email" id="email" placeholder="Your Email" size="37"/>
                </div>
                <div class="form-group formElement">
                    <label for="password"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;</label>
                    <input type="password" name="password" id="password" placeholder="Password" size="37"/>
                </div>
                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary btn-account" id="btn_login" value="Login">
                </div>
                <!--                    <div class="form-group mt-3">-->
                <!--                        <a class = "signup-image-link" href="resetPassword.php">Forgot Your Password?</a>-->
                <!--                    </div>-->
            </form>
        </div>
    </div>
</div>

<script>
    $('#login-form').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: "login.php",
            type: "POST",
            dataType: "application/json",
            data: $(this).serializeFormJSON(),

            complete: function (xhr, status){
                if (status !== 'error'){
                    location.href = "index.php";
                } else {
                    $("#error").html(xhr.responseText);
                }
            }
        });
    });
</script>

<?php
require './LayOut/footer.php';
?>
