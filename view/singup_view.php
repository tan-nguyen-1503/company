<div class="container" style="padding:150px 0px">
    <div class="row" id="signupForm">
        <div class="formpart col-lg-6 col-md-12 col-sm-12 col-12 mt-5">
            <div></div>
            <form method="POST" class="register-form" id="register-form">
                <h2 class="form-title mb-3">Sign up</h2>
                <p style="color:red;font-weight:700" id="Error"></p>
                <div class="form-group formElement">
                    <label for="name"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;</label>
                    <input type="text" name="name" id="name" placeholder="Your Name" size="37"/>
                </div>
                <div class="form-group formElement">
                    <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;</label>
                    <input type="email" name="email" id="email" placeholder="Your Email" size="37"/>
                </div>
                <div class="form-group formElement">
                    <label for="pass"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;</label>
                    <input type="password" name="password" id="pass" placeholder="Password" size="37"/>
                </div>
                <div class="form-group formElement">
                    <label for="re_pass"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;</label>
                    <input type="password" name="re_password" id="re_pass" placeholder="Repeat your password" size="37"/>
                </div>
                <div class="form-group mt-3 d-flex justify-content-left">
                    <button class="btn btn-primary btn-account" name="btn_register">Register</button>
                </div>
            </form>
        </div>
        <div class="imagesform col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="row d-flex flex-row justify-content-center">
                <div  class="imgdiv d-flex flex-row justify-content-center">
                    <img src="../Public/images/Account/signup-image.jpg" alt="signin-image.jpg">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="login.php" class="signup-image-link mb-2">I am already member</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $('#register-form').submit(function (e){
        e.preventDefault();
        $.ajax({
            url: "signup.php",
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
