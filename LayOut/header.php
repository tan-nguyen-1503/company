<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title></title>
    <link rel="stylesheet" href="../Public/styles/indexCss.css">
    <script src="../Public/script/jquery.js"></script>
    <link rel="stylesheet" href="../Public/styles/font-awesome.min.css">
    <link rel="stylesheet" href="../Public/styles/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- <script src="./Public/script/popper.min.js"></script> -->
    <script src="../Public/script/bootstrap.min.js"></script>
    <script src="../Public/script/formToJSON.js""></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .popover{
      width: 100%;
      max-width: 800px;
    }
    </style>
  </head>

  <body data-spy ="scroll" data-target="#navbarResponsive">
    <!--NavBar-->
    <nav style="height:90px" class="navbar navbar-expand-md navbar-dark">
      <a class="navbar-brand" href="index.php"><img src="./Public/images/Homepage/logoBK.png" alt="logo" style="width: 50px;"/></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"  aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="post.php">News</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our product</a>
            <div class="dropdown-menu account" aria-labelledby="navbarDropdown" >
                <?php
                    require 'model/Category.php';
                    $category_list = Category::getAll();
                    foreach ($category_list as $category){
                        echo "<a class='dropdown-item' href='product.php?categoryId=$category->id'>$category->category</a>";
                    }
                ?>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php" >Contact</a>
          </li>
        <?php
            if (isset($_SESSION['userId'])){
        ?>
        <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php" >Logout</a>
        </li>
        <?php
            } else {
        ?>
        <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="signup.php" >Sign up</a>
        </li>
        <?php
            }
        ?>
        </ul>
      </div>
    </nav>
    <!--End of NavBar-->
