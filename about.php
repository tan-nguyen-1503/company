<?php
require 'util.php';
require './LayOut/header.php';
?>
    <!-- Begin Breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb container">
        <li class="breadcrumb-item"><a href="index.php" style="color: black">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </nav>
    <!-- End Breadcrumb Area-->
    <div class="container">
        <!-- introduction-->
        <?php
            include_once './model/About.php';
            echo About::getAbout()->about;
        ?>
    </div>
<?php
require './LayOut/footer.php'
?>
