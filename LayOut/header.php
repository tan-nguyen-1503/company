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
    <nav style="height:90px" class="navbar navbar-expand-md navbar-dark <?php 
      if($_SERVER['REQUEST_URI'] == "/Ass/index.php"||$_SERVER['REQUEST_URI'] == "/Ass/"){
        echo "fixed-top";
      }
    ?>">
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
            <a class="nav-link" href="news.php">News</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Let's Shopping</a>
            <div class="dropdown-menu account" aria-labelledby="navbarDropdown" >
              <a class="dropdown-item" href="laptop.php"><img class="ml-1"src="https://img.icons8.com/nolan/32/000000/computer.png"> LAPTOP</a>
              <a class="dropdown-item" href="accessories.php"><img class="ml-1" src="https://img.icons8.com/dusk/32/000000/headphones.png"> ACCESSORI</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact" >Contact</a>
          </li>
        </ul>
      </div>
    </nav>
    <!--End of NavBar-->
